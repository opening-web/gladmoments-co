<?php

namespace App\Console\Commands;

use App\Models\Service;
use Illuminate\Console\Command;

class SetupDigitalInvitationForm extends Command
{
    protected $signature = 'setup:digital-invitation-form';
    protected $description = 'Setup Digital Invitation form with all fields and packages';

    public function handle()
    {
        $this->line("\n========================================");
        $this->line("SETTING UP DIGITAL INVITATION FORM");
        $this->line("========================================\n");

        // Get or create Digital Invitation service
        $service = Service::where('slug', 'digital-invitation')->first();

        if (!$service) {
            $this->error('Digital Invitation service not found. Creating...');
            $service = Service::create([
                'name' => 'Digital Invitation',
                'slug' => 'digital-invitation',
                'description' => 'Undangan digital dengan design custom, include musik, gallery foto, dan RSVP online.',
                'icon' => '💌',
            ]);
            $this->info('✅ Service created.');
        } else {
            $this->info('✅ Digital Invitation service found (ID: ' . $service->id . ')');
        }

        // Add packages if not exist
        if ($service->packages()->count() < 3) {
            $this->warn('Adding packages...');
            
            // Delete existing packages first
            $service->packages()->delete();

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
            $this->info('✅ 3 packages added.');
        } else {
            $this->info('✅ Packages already exist (' . $service->packages()->count() . ')');
        }

        // Display summary
        $this->line("\n========================================");
        $this->info("✅ SETUP COMPLETE!");
        $this->line("========================================");
        $this->line("Service: " . $service->name);
        $this->line("Packages:");
        foreach ($service->packages as $pkg) {
            $this->line("  • {$pkg->name} - Rp " . number_format($pkg->price, 0, ',', '.'));
        }
        $this->line("========================================\n");
    }
}
