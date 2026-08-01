<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
class MidtransWebhookController extends Controller
{
public function handle(Request $request)
{
$payload = $request->all();
$orderId = $payload['order_id'] ?? null;
$transactionStatus = $payload['transaction_status'] ?? null;
$fraudStatus = $payload['fraud_status'] ?? null;

if (!$orderId) {
return response()->json(['message' => 'Invalid payload'], 400);
}

// Mencari ID transaksi tersebut di database lokal kita
$transaction = Transaction::with('event')->where('order_id',
$orderId)->first();

if (!$transaction) {
return response()->json(['message' => 'Transaction not found'],
404);
}

// Cegah proses berulang jika status sudah lunas/sukses
if ($transaction->status === 'settlement' || $transaction->status ===
'success') {
    return response()->json(['message' => 'Already processed']);
}

// Logika Penerjemahan Status Midtrans API
if ($transactionStatus == 'capture') {
if ($fraudStatus == 'challenge') {
$transaction->status = 'challenge';
} else if ($fraudStatus == 'accept') {
$transaction->status = 'success';
$this->processSuccess($transaction);
}
} else if ($transactionStatus == 'settlement') {
$transaction->status = 'settlement';
$this->processSuccess($transaction);
} else if (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
    if (strtolower($transaction->status) === 'pending' && $transaction->event) {
        // Kembalikan stok (release) karena pembayaran kedaluwarsa atau dibatalkan
        $transaction->event->increment('stock');
    }
    $transaction->status = 'failed';
} else if ($transactionStatus == 'pending') {
$transaction->status = 'pending';
}

$transaction->save();
return response()->json(['message' => 'OK']);
}

private function processSuccess(Transaction $transaction)
{
$event = $transaction->event;

if ($event) {
// Mengirimkan email E-Ticket ke pelanggan
try {
\Illuminate\Support\Facades\Mail::to($transaction->customer_email)->send(new
\App\Mail\EventTicketMail($transaction));

// Kirim E-Ticket via WhatsApp
app(\App\Services\WhatsAppService::class)->sendETicket($transaction);
} catch (\Exception $e) {
    \Log::error('Gagal mengirim email/WA E-Ticket: ' .
$e->getMessage());
}
} else {
\Log::warning('Event tidak ditemukan saat proses email E-Ticket. Order: ' . $transaction->order_id);
}
}

}