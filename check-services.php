#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

$app = require __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Service;

$services = Service::with('packages')->get();

echo "\n========================================\n";
echo "SERVICES & PACKAGES IN DATABASE\n";
echo "========================================\n\n";

foreach ($services as $service) {
    echo "📦 ID: {$service->id} | Name: {$service->name} | Slug: {$service->slug}\n";
    echo "   Packages ({$service->packages->count()}):\n";
    foreach ($service->packages as $pkg) {
        echo "      ✓ [{$pkg->id}] {$pkg->name} - Rp " . number_format($pkg->price, 0, ',', '.') . "\n";
    }
    echo "\n";
}

echo "========================================\n";
if (Service::where('name', 'Digital Invitation')->exists()) {
    echo "✅ Digital Invitation service FOUND in database!\n";
    $di = Service::where('name', 'Digital Invitation')->first();
    echo "   Total packages: " . $di->packages->count() . "\n";
} else {
    echo "❌ Digital Invitation service NOT found in database.\n";
    echo "   Packages will use config fallback instead.\n";
}
echo "========================================\n\n";
?>
