<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$partners = \App\Models\Partner::all();
foreach($partners as $p) {
    echo $p->name . " => " . $p->logo_url . "\n";
}
