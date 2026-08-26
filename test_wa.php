<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$transaction = App\Models\Transaction::where('status', 'success')->latest()->first();
if ($transaction) {
    app(\App\Services\WhatsAppService::class)->sendETicket($transaction);
    echo "Pesan dikirim ke {$transaction->customer_phone}\n";
} else {
    echo "Tidak ada transaksi sukses.\n";
}
