<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class AddDigitalInvitationSeeder extends Seeder
{
    /**
     * Seed the Digital Invitation service and packages.
     * Run this if database already exists with other services.
     * Command: php artisan db:seed --class=AddDigitalInvitationSeeder
     */
    public function run(): void
    {
        // Check if Digital Invitation service already exists
        $exists = Service::where('slug', 'digital-invitation')->exists();

        if ($exists) {
            $this->command->info('Digital Invitation service already exists. Skipping...');
            return;
        }

        $digitalInvitation = Service::create([
            'name' => 'Digital Invitation',
            'slug' => 'digital-invitation',
            'description' => 'Undangan digital interaktif untuk pernikahan dengan galeri foto, RSVP, dan berbagai fitur premium.',
            'icon' => '💌',
        ]);

        $digitalInvitation->packages()->createMany([
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

        $this->command->info('✅ Digital Invitation service and packages added successfully!');
    }
}
