<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    /**
     * Send E-Ticket Notification
     */
    public function sendETicket(Transaction $transaction)
    {
        // Pastikan nomor WhatsApp ada
        if (empty($transaction->customer_phone)) {
            return;
        }

        $eventName = $transaction->event ? $transaction->event->title : 'Event AmikomHub';
        
        $message = "Halo *{$transaction->customer_name}*,\n\n";
        $message .= "Pembayaran untuk pesanan tiket *{$eventName}* (Order ID: {$transaction->order_id}) telah BERHASIL.\n\n";
        $message .= "E-Ticket Anda juga telah dikirimkan ke email: {$transaction->customer_email}\n\n";
        $message .= "Terima kasih telah menggunakan layanan AmikomHub!\n";
        $message .= "Harap simpan bukti pembayaran dan E-Ticket ini untuk ditunjukkan pada saat acara.";

        $this->sendFonnte($transaction->customer_phone, $message);
    }

    /**
     * Send Payment Reminder (Abandoned Cart)
     */
    public function sendPaymentReminder(Transaction $transaction)
    {
        if (empty($transaction->customer_phone)) {
            return;
        }

        $eventName = $transaction->event ? $transaction->event->title : 'Event AmikomHub';
        $paymentLink = route('checkout.payment', $transaction->order_id);
        
        $message = "Halo *{$transaction->customer_name}*,\n\n";
        $message .= "Kami melihat Anda belum menyelesaikan pembayaran untuk tiket *{$eventName}* (Order ID: {$transaction->order_id}).\n\n";
        $message .= "Total Tagihan: Rp " . number_format($transaction->total_price, 0, ',', '.') . "\n\n";
        $message .= "Silakan klik link berikut untuk segera menyelesaikan pembayaran Anda sebelum tiket kedaluwarsa:\n";
        $message .= $paymentLink . "\n\n";
        $message .= "Abaikan pesan ini jika Anda sudah membayar atau ingin membatalkan pesanan.";

        $this->sendFonnte($transaction->customer_phone, $message);
    }

    /**
     * Helper to send Fonnte Request
     */
    private function sendFonnte($target, $message)
    {
        $token = env('FONNTE_TOKEN');

        if (empty($token)) {
            Log::warning('Fonnte Token tidak ditemukan di .env (FONNTE_TOKEN). Gagal mengirim pesan WA.');
            return;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $token
            ])->post('https://api.fonnte.com/send', [
                'target' => $target,
                'message' => $message,
                'countryCode' => '62', // Default kode negara Indonesia
            ]);

            if (!$response->successful()) {
                Log::error('Gagal mengirim WhatsApp via Fonnte: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('Exception saat mengirim WhatsApp via Fonnte: ' . $e->getMessage());
        }
    }
}
