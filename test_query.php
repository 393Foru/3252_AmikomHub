<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$u = \App\Models\User::find(23);
if ($u) {
    echo "User: " . $u->name . ", role: " . $u->role . ", partner_id: " . $u->partner_id . "\n";
    $tx = \App\Models\Transaction::whereHas('event', function($eq) use ($u) {
        $eq->where('partner_id', $u->partner_id);
    })->count();
    $tx_all = \App\Models\Transaction::count();
    echo "Transactions with partner_id " . $u->partner_id . ": " . $tx . "\n";
    echo "All transactions: " . $tx_all . "\n";

    // Test when clause
    $tx_when = \App\Models\Transaction::when($u->partner_id, function($q) use ($u) {
        return $q->whereHas('event', function($eq) use ($u) {
            $eq->where('partner_id', $u->partner_id);
        });
    })->count();
    echo "Transactions with when(): " . $tx_when . "\n";
} else {
    echo "User not found\n";
}
