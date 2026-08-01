<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Partner;
use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

$cloudinary = new Cloudinary(env('CLOUDINARY_URL'));
$migratedPartners = 0;

$partners = Partner::whereNotNull('logo_url')->get();
foreach ($partners as $partner) {
    if (!Str::startsWith($partner->logo_url, 'http') && Storage::disk('public')->exists($partner->logo_url)) {
        echo "Migrating Partner Logo: " . $partner->name . "\n";
        $path = Storage::disk('public')->path($partner->logo_url);
        try {
            $response = $cloudinary->uploadApi()->upload($path, [
                'folder' => 'partners',
                'format' => 'webp',
                'quality' => 'auto'
            ]);
            $oldPath = $partner->logo_url;
            $partner->logo_url = $response['secure_url'];
            $partner->save();
            // Don't delete immediately to avoid missing file for duplicates
            // Storage::disk('public')->delete($oldPath);
            $migratedPartners++;
        } catch (\Exception $e) {
            echo "Failed: " . $e->getMessage() . "\n";
        }
    }
}
echo "Migrated $migratedPartners partners.\n";
