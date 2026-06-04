<?php

namespace App\Console\Commands;

use App\Models\Service;
use Illuminate\Console\Command;

class SyncDigitalInvitationPackages extends Command
{
    protected $signature = 'sync:digital-invitation';
    protected $description = 'Add Digital Invitation packages to database';

    public function handle()
    {
        $service = Service::where('slug', 'digital-invitation')->first();

        if (!$service) {
            $this->error('❌ Digital Invitation service not found. Creating...');
            $service = Service::create([
                'name' => 'Digital Invitation',
                'slug' => 'digital-invitation',
                'description' => 'Undangan digital interaktif untuk pernikahan dengan galeri foto, RSVP, dan berbagai fitur premium.',
                'icon' => '💌',
            ]);
            $this->info('✅ Digital Invitation service created.');
        }

        // Delete existing packages if any
        if ($service->packages()->count() > 0) {
            $this->warn('Removing ' . $service->packages()->count() . ' existing packages...');
            $service->packages()->delete();
        }

        // Add all packages
        $service->packages()->createMany([
            [
                'name' => 'Digital Invitation Basic',
                'description' => 'Desain template standar, RSVP interaktif, galeri foto hingga 14 foto, animasi sederhana',
                'price' => 2000000,
            ],
            [
                'name' => 'Digital Invitation Premium',
                'description' => 'Template premium pilihan, video undangan 30 detik, musik background, animasi advanced, live countdown',
                'price' => 4000000,
            ],
            [
                'name' => 'Digital Invitation Deluxe',
                'description' => 'Desain custom, video undangan 1 menit, greeting message keluarga, money box integration, analytics lengkap',
                'price' => 6500000,
            ],
        ]);

        $this->info('✅ Digital Invitation packages synced successfully!');
        $this->line('   Packages added: ' . $service->packages()->count());
        
        foreach ($service->packages as $pkg) {
            $this->line('      • ' . $pkg->name . ' - Rp ' . number_format($pkg->price, 0, ',', '.'));
        }
    }
}
