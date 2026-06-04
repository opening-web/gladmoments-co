<?php

namespace App\Console\Commands;

use App\Models\Service;
use Illuminate\Console\Command;

class CheckServices extends Command
{
    protected $signature = 'check:services';
    protected $description = 'Check all services and packages in database';

    public function handle()
    {
        $services = Service::with('packages')->get();

        $this->line("\n========================================");
        $this->line("SERVICES & PACKAGES IN DATABASE");
        $this->line("========================================\n");

        foreach ($services as $service) {
            $this->line("📦 ID: {$service->id} | Name: {$service->name} | Slug: {$service->slug}");
            $this->line("   Packages ({$service->packages->count()}):");
            foreach ($service->packages as $pkg) {
                $this->line("      ✓ [{$pkg->id}] {$pkg->name} - Rp " . number_format($pkg->price, 0, ',', '.'));
            }
            $this->line("");
        }

        $this->line("========================================");
        if (Service::where('name', 'Digital Invitation')->exists()) {
            $this->info("✅ Digital Invitation service FOUND in database!");
            $di = Service::where('name', 'Digital Invitation')->first();
            $this->info("   Total packages: " . $di->packages->count());
        } else {
            $this->error("❌ Digital Invitation service NOT found in database.");
            $this->warn("   Packages will use config fallback instead.");
        }
        $this->line("========================================\n");
    }
}
