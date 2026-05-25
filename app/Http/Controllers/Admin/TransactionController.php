<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction; // Pastikan model Transaction di-import
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Menampilkan daftar transaksi.
     */
    public function index()
    {
        // Mengambil data transaksi terbaru, dibatasi 10 per halaman
        // Jika tabel transactions berelasi dengan tabel events atau users, 
        // kamu bisa menggunakan ->with(['event', 'user']) sebelum ->latest()
        $transactions = Transaction::latest()->paginate(10);

        // Menampilkan view admin/transactions/index.blade.php
        return view('admin.transactions.index', compact('transactions'));
    }
}