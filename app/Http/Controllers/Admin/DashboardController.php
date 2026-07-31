<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->partner_id) {
            $totalRevenue = Transaction::whereIn('status', ['settlement', 'success'])
                ->whereHas('event', function($q) use ($user) {
                    $q->where('partner_id', $user->partner_id);
                })->sum('total_price');

            $ticketsSold = Transaction::whereIn('status', ['settlement', 'success'])
                ->whereHas('event', function($q) use ($user) {
                    $q->where('partner_id', $user->partner_id);
                })->count();

            $activeEvents = Event::where('date', '>=', now())
                ->where('partner_id', $user->partner_id)->count();

            $pendingOrders = Transaction::where('status', 'pending')
                ->whereHas('event', function($q) use ($user) {
                    $q->where('partner_id', $user->partner_id);
                })->count();

            $recentTransactions = Transaction::with('event')
                ->whereHas('event', function($q) use ($user) {
                    $q->where('partner_id', $user->partner_id);
                })->latest()->take(5)->get();
        } else {
            $totalRevenue = Transaction::whereIn('status', ['settlement', 'success'])->sum('total_price');
            $ticketsSold = Transaction::whereIn('status', ['settlement', 'success'])->count();
            $activeEvents = Event::where('date', '>=', now())->count();
            $pendingOrders = Transaction::where('status', 'pending')->count();
            $recentTransactions = Transaction::with('event')->latest()->take(5)->get();
        }

        return view('admin.dashboard', compact('totalRevenue', 'ticketsSold', 'activeEvents', 'pendingOrders', 'recentTransactions'));
    }
}