<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$partners = \App\Models\Partner::all();
echo "Found " . count($partners) . " partners.\n";
$i = 0;
foreach ($partners as $partner) {
    $logoNum = ($i % 8) + 1;
    $partner->logo_url = 'partners/partner-' . $logoNum . '.png';
    $partner->save();
    echo "Updated partner " . $partner->name . "\n";
    $i++;
}
echo "Partners updated successfully.\n";
