<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Http\Kernel')->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\Service;

$services = Service::with('packages')->get();

echo "=== SERVICES IN DATABASE ===\n\n";
foreach ($services as $service) {
    echo "📦 " . $service->name . " (slug: {$service->slug})\n";
    echo "   Packages: " . $service->packages->count() . "\n";
    foreach ($service->packages as $pkg) {
        echo "     - " . $pkg->name . " (Rp " . number_format($pkg->price, 0, ',', '.') . ")\n";
    }
    echo "\n";
}
