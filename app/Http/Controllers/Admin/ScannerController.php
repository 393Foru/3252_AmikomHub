<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Jobs\GenerateAndSendCertificateJob;

class ScannerController extends Controller
{
    public function scan(Request $request)
    {
        $request->validate([
            'order_id' => 'required|string'
        ]);

        $transaction = Transaction::with('event')->where('order_id', $request->order_id)->first();

        if (!$transaction) {
            return response()->json(['success' => false, 'message' => 'Tiket tidak ditemukan.'], 404);
        }

        if ($transaction->status !== 'success' && $transaction->status !== 'settlement') {
            return response()->json(['success' => false, 'message' => 'Status pembayaran tiket ini belum lunas.'], 400);
        }

        if ($transaction->is_checked_in) {
            return response()->json(['success' => false, 'message' => 'Tiket ini sudah pernah digunakan untuk check-in.'], 400);
        }

        // Proses Check-in
        $transaction->update([
            'is_checked_in' => true,
            'checked_in_at' => now()
        ]);

        // Cek apakah event menggunakan sertifikat
        if ($transaction->event->has_certificate && !$transaction->certificate_sent) {
            // Dispatch Job
            GenerateAndSendCertificateJob::dispatch($transaction);
        }

        return response()->json([
            'success' => true, 
            'message' => 'Check-in berhasil! ' . ($transaction->event->has_certificate ? 'E-Certificate sedang diproses dan akan dikirim ke email.' : ''),
            'data' => [
                'customer_name' => $transaction->customer_name,
                'event_title' => $transaction->event->title
            ]
        ]);
    }
}
