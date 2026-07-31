<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $query = Transaction::with('event')->latest();

        if ($user->partner_id) {
            $query->whereHas('event', function ($q) use ($user) {
                $q->where('partner_id', $user->partner_id);
            });
        }

        $transactions = $query->paginate(20);
        return view('admin.transactions.index', compact('transactions'));
    }
}