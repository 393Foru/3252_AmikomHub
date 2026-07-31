<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $user = auth()->user();
        $filter = $request->query('filter', 'all'); // default 'all'

        // Set date range based on filter
        $startDate = null;
        $prevStartDate = null;
        $prevEndDate = null;
        $filterLabel = '';
        
        if ($filter === 'today') {
            $startDate = now()->startOfDay();
            $prevStartDate = now()->subDay()->startOfDay();
            $prevEndDate = now()->subDay()->endOfDay();
            $filterLabel = 'vs kemarin';
        } elseif ($filter === 'week') {
            $startDate = now()->startOfWeek();
            $prevStartDate = now()->subWeek()->startOfWeek();
            $prevEndDate = now()->subWeek()->endOfWeek();
            $filterLabel = 'vs mgg lalu';
        } elseif ($filter === 'month') {
            $startDate = now()->startOfMonth();
            $prevStartDate = now()->subMonth()->startOfMonth();
            $prevEndDate = now()->subMonth()->endOfMonth();
            $filterLabel = 'vs bln lalu';
        }

        // Helper closures for base queries
        $trxQuery = function($status, $start = null, $end = null) use ($user) {
            $q = Transaction::whereIn('status', (array) $status);
            if ($start) $q->where('created_at', '>=', $start);
            if ($end) $q->where('created_at', '<=', $end);
            
            if ($user->partner_id) {
                $q->whereHas('event', function($eq) use ($user) {
                    $eq->where('partner_id', $user->partner_id);
                });
            }
            return $q;
        };

        $eventQuery = function($start = null, $end = null) use ($user) {
            $q = Event::where('date', '>=', now()); // Active events are future events
            if ($start) $q->where('created_at', '>=', $start);
            if ($end) $q->where('created_at', '<=', $end);
            
            if ($user->partner_id) {
                $q->where('partner_id', $user->partner_id);
            }
            return $q;
        };

        $totalRevenue = $trxQuery(['settlement', 'success'], $startDate)->sum('total_price');
        $ticketsSold = $trxQuery(['settlement', 'success'], $startDate)->count();
        $activeEvents = $eventQuery($startDate)->count();
        $pendingOrders = $trxQuery('pending', $startDate)->count();
        
        // Previous period calculations
        $prevRevenue = $prevStartDate ? $trxQuery(['settlement', 'success'], $prevStartDate, $prevEndDate)->sum('total_price') : null;
        $prevTickets = $prevStartDate ? $trxQuery(['settlement', 'success'], $prevStartDate, $prevEndDate)->count() : null;
        $prevActive = $prevStartDate ? $eventQuery($prevStartDate, $prevEndDate)->count() : null;
        $prevPending = $prevStartDate ? $trxQuery('pending', $prevStartDate, $prevEndDate)->count() : null;

        // Calculate percentage changes
        $calculateTrend = function($current, $previous) {
            if ($previous === null) return null; // 'all' filter
            if ($previous == 0) return $current > 0 ? 100 : 0;
            return round((($current - $previous) / $previous) * 100, 1);
        };

        $trends = [
            'revenue' => $calculateTrend($totalRevenue, $prevRevenue),
            'tickets' => $calculateTrend($ticketsSold, $prevTickets),
            'events' => $calculateTrend($activeEvents, $prevActive),
            'pending' => $calculateTrend($pendingOrders, $prevPending),
            'label' => $filterLabel
        ];
        
        // Recent transactions always show latest regardless of time filter
        $recentTransactions = Transaction::with('event')
            ->when($user->partner_id, function($q) use ($user) {
                return $q->whereHas('event', function($eq) use ($user) {
                    $eq->where('partner_id', $user->partner_id);
                });
            })->latest()->take(10)->get();

        $chartFilter = $request->query('chart_filter', '7d');
        
        $chartStartDate = match($chartFilter) {
            '1m' => now()->subDays(29)->startOfDay(),
            '3m' => now()->subWeeks(11)->startOfWeek(),
            '6m' => now()->subWeeks(23)->startOfWeek(),
            '1y' => now()->subMonths(11)->startOfMonth(),
            default => now()->subDays(6)->startOfDay(),
        };

        $chartTransactions = Transaction::with('event.category')
            ->whereIn('status', ['settlement', 'success'])
            ->where('created_at', '>=', $chartStartDate)
            ->when($user->partner_id, function($q) use ($user) {
                return $q->whereHas('event', function($eq) use ($user) {
                    $eq->where('partner_id', $user->partner_id);
                });
            })
            ->get(['id', 'created_at', 'total_price', 'event_id']);
            
        $chartDates = [];
        $chartRevenue = [];
        
        if ($chartFilter === '7d' || $chartFilter === '1m') {
            $days = $chartFilter === '7d' ? 7 : 30;
            for ($i = $days - 1; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $dateString = $date->format('Y-m-d');
                $chartDates[] = $date->format('d M');
                $chartRevenue[] = $chartTransactions->filter(fn($t) => $t->created_at->format('Y-m-d') === $dateString)->sum('total_price');
            }
        } elseif ($chartFilter === '3m' || $chartFilter === '6m') {
            $weeks = $chartFilter === '3m' ? 12 : 24;
            for ($i = $weeks - 1; $i >= 0; $i--) {
                $startOfWeek = now()->subWeeks($i)->startOfWeek();
                $endOfWeek = now()->subWeeks($i)->endOfWeek();
                $chartDates[] = $startOfWeek->format('d/m') . ' - ' . $endOfWeek->format('d/m');
                $chartRevenue[] = $chartTransactions->filter(fn($t) => $t->created_at >= $startOfWeek && $t->created_at <= $endOfWeek)->sum('total_price');
            }
        } elseif ($chartFilter === '1y') {
            for ($i = 11; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $monthString = $date->format('Y-m');
                $chartDates[] = $date->format('M Y');
                $chartRevenue[] = $chartTransactions->filter(fn($t) => $t->created_at->format('Y-m') === $monthString)->sum('total_price');
            }
        }

        // Process Category Distribution
        $categoryData = [];
        foreach ($chartTransactions as $trx) {
            $catName = $trx->event->category->name ?? 'Lainnya';
            if (!isset($categoryData[$catName])) {
                $categoryData[$catName] = 0;
            }
            $categoryData[$catName]++;
        }
        
        // Sort categories by highest sales
        arsort($categoryData);
        $categoryChartLabels = array_keys($categoryData);
        $categoryChartData = array_values($categoryData);

        // Fetch Recent Activity Logs
        $recentEventLogs = Event::with('owner')
            ->when($user->partner_id, function($q) use ($user) {
                return $q->where('partner_id', $user->partner_id);
            })
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($event) {
                return (object)[
                    'type' => 'event',
                    'title' => 'Event baru: ' . $event->title,
                    'subtitle' => 'Dibuat oleh ' . ($event->owner ? $event->owner->name : 'Penyelenggara Utama'),
                    'time' => $event->created_at,
                    'icon' => 'calendar'
                ];
            });

        $recentTransactionLogs = Transaction::with('event')
            ->whereIn('status', ['settlement', 'success'])
            ->when($user->partner_id, function($q) use ($user) {
                return $q->whereHas('event', function($eq) use ($user) {
                    $eq->where('partner_id', $user->partner_id);
                });
            })
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($trx) {
                return (object)[
                    'type' => 'transaction',
                    'title' => 'Pembelian Tiket Berhasil',
                    'subtitle' => $trx->customer_name . ' membeli tiket ' . ($trx->event->title ?? '-'),
                    'time' => $trx->created_at,
                    'icon' => 'ticket'
                ];
            });

        $activityLogs = collect($recentEventLogs)
            ->merge($recentTransactionLogs)
            ->sortByDesc('time')
            ->take(6)
            ->values();

        $topEvents = Event::withCount(['transactions as sales_count' => function($q) use ($startDate) {
                $q->whereIn('status', ['settlement', 'success'])
                  ->when($startDate, function($query) use ($startDate) {
                      return $query->where('created_at', '>=', $startDate);
                  });
            }])
            ->withSum(['transactions as total_revenue' => function($q) use ($startDate) {
                $q->whereIn('status', ['settlement', 'success'])
                  ->when($startDate, function($query) use ($startDate) {
                      return $query->where('created_at', '>=', $startDate);
                  });
            }], 'total_price')
            ->when($user->partner_id, function($q) use ($user) {
                return $q->where('partner_id', $user->partner_id);
            })
            ->having('sales_count', '>', 0)
            ->orderByDesc('sales_count')
            ->take(5)
            ->get();

        $capacityEvents = Event::withCount(['transactions as sold_tickets' => function($q) {
                $q->whereIn('status', ['settlement', 'success']);
            }])
            ->where('date', '>=', now())
            ->when($user->partner_id, function($q) use ($user) {
                return $q->where('partner_id', $user->partner_id);
            })
            ->get()
            ->map(function($event) {
                $totalCapacity = $event->stock + $event->sold_tickets;
                $percentage = $totalCapacity > 0 ? round(($event->sold_tickets / $totalCapacity) * 100) : 0;
                $event->total_capacity = $totalCapacity;
                $event->sold_percentage = $percentage;
                return $event;
            })
            ->sortByDesc('sold_percentage')
            ->take(5)
            ->values();

        return view('admin.dashboard', compact('totalRevenue', 'ticketsSold', 'activeEvents', 'pendingOrders', 'recentTransactions', 'chartDates', 'chartRevenue', 'categoryChartLabels', 'categoryChartData', 'filter', 'chartFilter', 'activityLogs', 'trends', 'topEvents', 'capacityEvents'));
    }
}