<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
public function create(Event $event)
{
// Mengambil daftar kategori untuk keperluan menu footer
$categories = \App\Models\Category::all();

return view('checkout.create', compact('event','categories'));
}

public function store(Request $request, Event $event)
{
// 1. Validasi Input Kredensial Pelanggan
$request->validate([
'customer_name' => 'required|string|max:255',
'customer_email' => 'required|email|max:255',
'customer_phone' => 'required|string|max:20',
]);

// Gunakan DB Transaction untuk mengamankan perubahan stock (Race Condition)
\Illuminate\Support\Facades\DB::beginTransaction();

try {
    // 2. Lock event row untuk mengamankan pengecekan stock
    $lockedEvent = \App\Models\Event::where('id', $event->id)->lockForUpdate()->first();

    // 3. Cegah Check-out Jika Tiket Habis
    if (!$lockedEvent || $lockedEvent->stock <= 0) {
        \Illuminate\Support\Facades\DB::rollBack();
        return back()->with('error', 'Mohon maaf, tiket untuk acara ini sudah habis.');
    }

    // 4. Kurangi stock sekarang (Reserve)
    $lockedEvent->decrement('stock');

    // 5. Generate Kode TRX (Unik)
    $orderId = 'TRX-' . time() . '-' . Str::random(5);
    $isAdminFeeApplied = $lockedEvent->price > 0;
    $totalPrice = $lockedEvent->price + ($isAdminFeeApplied ? 5000 : 0); // Bebas admin fee jika gratis

    // 6. Merekam Transaksi ke Database
    $transaction = Transaction::create([
        'event_id' => $lockedEvent->id,
        'order_id' => $orderId,
        'customer_name' => $request->customer_name,
        'customer_email' => $request->customer_email,
        'customer_phone' => $request->customer_phone,
        'total_price' => $totalPrice,
        'status' => $totalPrice == 0 ? 'success' : 'Pending', // Status Awal
    ]);

    \Illuminate\Support\Facades\DB::commit();

    // 7. Bypass Logika untuk Free Event
    if ($totalPrice == 0) {
        try {
            \Illuminate\Support\Facades\Mail::to($transaction->customer_email)
                ->send(new \App\Mail\EventTicketMail($transaction));
                
            // Kirim E-Ticket via WhatsApp
            app(\App\Services\WhatsAppService::class)->sendETicket($transaction);
        } catch (\Exception $e) {
            \Log::error('Gagal mengirim email/WA E-Ticket untuk acara gratis: ' . $e->getMessage());
        }

        return redirect()->route('checkout.success', $transaction->order_id)
            ->with('success', 'Pendaftaran berhasil! E-Ticket telah dikirim ke email & WhatsApp Anda.');
    }
} catch (\Exception $e) {
    \Illuminate\Support\Facades\DB::rollBack();
    return back()->with('error', 'Terjadi kesalahan sistem saat memproses pesanan: ' . $e->getMessage());
}

// 7. 
// --- INTEGRASI SNAP MIDTRANS ---

// Konfigurasi Kredensial Environment Midtrans
\Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
\Midtrans\Config::$isProduction = false; // Mode Sandbox!
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

// Susun Paket Array Data Transaksi
$params = [
    'transaction_details' => [
    'order_id' => $orderId,
    'gross_amount' => $totalPrice,
],
    'customer_details' => [
        'first_name' => $request->customer_name,
        'email' => $request->customer_email,
        'phone' => $request->customer_phone,
    ],
    'callbacks' => [
        'finish' => route('checkout.success', $orderId),
        'error' => route('checkout.failed', $orderId),
        'pending' => route('checkout.success', $orderId),
    ],
    'custom_expiry' => [
        'expiry_duration' => 60,
        'unit' => 'minute'
    ],
];

try {
    // Perintah Tembak Generate Snap Token
    $snapToken = \Midtrans\Snap::getSnapToken($params);

    // Update rekaman kita bahwa transaksi terkait sudah memiliki id token pelunasan
    $transaction->update(['snap_token' => $snapToken]);

    // Redirect ke halaman antarmuka pembayaran final pelanggan
    return redirect()->route('checkout.payment',
    $transaction->order_id);

} catch (\Exception $e) {
    // Jika gagal mendapatkan Snap Token, kembalikan stok tiket
    if (isset($transaction) && $transaction->status === 'Pending') {
        $transaction->update(['status' => 'failed']);
        if ($transaction->event) {
            $transaction->event->increment('stock');
        }
    }
    
    return back()->with('error', 'Gagal memproses pembayaran jaringan: '
. $e->getMessage());
}

return redirect('/');
}

public function payment($order_id)
{
// Mengambil daftar kategori untuk keperluan menu footer
$categories = \App\Models\Category::all();

$transaction = Transaction::with('event')->where('order_id',
$order_id)->firstOrFail();
return view('checkout.payment', compact('transaction','categories'));
}

public function failed($order_id)
{
    // Mengambil daftar kategori untuk keperluan menu footer
    $categories = \App\Models\Category::all();
    
    $transaction = Transaction::with('event')->where('order_id', $order_id)->firstOrFail();
    
    // Bisa memperbarui status menjadi failed jika diperlukan
    if (strtolower($transaction->status) === 'pending') {
        $transaction->update(['status' => 'failed']);
    }

    return view('checkout.failed', compact('transaction', 'categories'));
}

public function success($order_id)
{
// Mengambil daftar kategori untuk keperluan menu footer
$categories = \App\Models\Category::all();

$transaction = Transaction::with('event')->where('order_id',
$order_id)->firstOrFail();

// Bypass Pengecekan Midtrans jika ini adalah transaksi gratis
if ($transaction->total_price == 0 && strtolower($transaction->status) === 'success') {
    return view('checkout.success', compact('transaction', 'categories'));
}

// Konfigurasi Midtrans untuk mengecek status transaksi langsung ke API
\Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');

\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

try {
// Mengecek status pesanan secara mandiri (Bypass)
$status = \Midtrans\Transaction::status($order_id);

if ($status) {
// Mengambil nilai status transaksi
$trx_status = is_array($status) ? ($status['transaction_status']
?? '') : ($status->transaction_status ?? '');

// Jika API Midtrans mengonfirmasi bahwa transaksi telah berhasil (settlement / capture)
if (in_array($trx_status, ['settlement', 'capture'])) {
// Hanya lakukan update jika status di database lokal masih 'pending' (indikasi Webhook tidak masuk)
if (strtolower($transaction->status) === 'pending') {
$transaction->update(['status' => 'success']);

if ($transaction->event) {
try {

\Illuminate\Support\Facades\Mail::to($transaction->customer_email)
->send(new
\App\Mail\EventTicketMail($transaction));

// Kirim E-Ticket via WhatsApp
app(\App\Services\WhatsAppService::class)->sendETicket($transaction);
} catch (\Exception $e) {
\Log::error('Gagal mengirim email/WA E-Ticket
secara manual (Bypass): ' . $e->getMessage());
}
}
}
}
}
} catch (\Exception $e) {
// Jika terjadi error dari API Midtrans (transaksi tidak valid),kembalikan ke beranda
return redirect()->route('home')->with('error', 'Transaksi tidak
ditemukan atau gagal diproses oleh sistem pembayaran.');
}

return view('checkout.success', compact('transaction', 'categories'));
}

}