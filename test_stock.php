<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

foreach(\App\Models\Event::all() as $e) {
    $trx = \App\Models\Transaction::where('event_id', $e->id)->where('status', 'Success')->count();
    echo $e->title . ' | Stock: ' . $e->stock . ' | TRX: ' . $trx . PHP_EOL;
}
