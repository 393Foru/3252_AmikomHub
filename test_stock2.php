<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

foreach(\App\Models\Event::all() as $e) {
    $trxCount = \App\Models\Transaction::where('event_id', $e->id)->count();
    $trxSuccess = \App\Models\Transaction::where('event_id', $e->id)->where('status', 'Success')->count();
    echo "ID: $e->id | Title: $e->title | Stock: $e->stock | TotalTRX: $trxCount | SuccessTRX: $trxSuccess\n";
}
