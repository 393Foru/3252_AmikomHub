<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Event;
use App\Models\Partner;
use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

$cloudinary = new Cloudinary(env('CLOUDINARY_URL'));
$migratedEvents = 0;
$migratedPartners = 0;

echo "Starting Migration...\n";

// Migrate Events
$events = Event::whereNotNull('poster_path')->get();
foreach ($events as $event) {
    if (!Str::startsWith($event->poster_path, 'http') && Storage::disk('public')->exists($event->poster_path)) {
        echo "Migrating Event Poster: " . $event->title . "\n";
        $path = Storage::disk('public')->path($event->poster_path);
        try {
            $response = $cloudinary->uploadApi()->upload($path, [
                'folder' => 'events',
                'format' => 'webp',
                'quality' => 'auto'
            ]);
            $oldPath = $event->poster_path;
            $event->poster_path = $response['secure_url'];
            $event->save();
            Storage::disk('public')->delete($oldPath);
            $migratedEvents++;
        } catch (\Exception $e) {
            echo "Failed: " . $e->getMessage() . "\n";
        }
    }
}

// Migrate Partners
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
            Storage::disk('public')->delete($oldPath);
            $migratedPartners++;
        } catch (\Exception $e) {
            echo "Failed: " . $e->getMessage() . "\n";
        }
    }
}

// Migrate Hero Assets
$assets = Storage::disk('public')->files('assets');
$heroUrls = [];
$migratedAssets = 0;
foreach ($assets as $asset) {
    if (preg_match('/\.(jpg|jpeg|png|webp|gif)$/i', $asset)) {
        echo "Migrating Hero Asset: " . $asset . "\n";
        $path = Storage::disk('public')->path($asset);
        try {
            $response = $cloudinary->uploadApi()->upload($path, [
                'folder' => 'hero_assets',
                'format' => 'webp',
                'quality' => 'auto'
            ]);
            $heroUrls[] = $response['secure_url'];
            Storage::disk('public')->delete($asset);
            $migratedAssets++;
        } catch (\Exception $e) {
            echo "Failed: " . $e->getMessage() . "\n";
        }
    }
}

if (!empty($heroUrls)) {
    file_put_contents(storage_path('app/hero_images.json'), json_encode($heroUrls));
    Storage::disk('public')->deleteDirectory('assets');
}

echo "Migrated $migratedEvents events, $migratedPartners partners, and $migratedAssets hero assets.\n";
