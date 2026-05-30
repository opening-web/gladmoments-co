<?php

namespace App\Console\Commands;

use App\Models\Service;
use Illuminate\Console\Command;

class SeedPackages extends Command
{
    protected $signature = 'seed:packages';
    protected $description = 'Seed packages for booking services (Photobooth, Audio, Bundle)';

    public function handle()
    {
        $this->info('Seeding packages for booking services...');

        // Seed Glad to Call (Audio Guestbook)
        $gladtocall = Service::firstOrCreate(
            ['slug' => 'gladtocall'],
            [
                'name' => 'Glad to Call',
                'description' => 'Audio guestbook berkonsep telepon retro, menghadirkan pengalaman nostalgia dan interaksi tamu yang tak terlupakan.',
                'icon' => '🎙️',
            ]
        );

        $audioPackages = [
            [
                'name' => 'Audio Guestbook (2 jam)',
                'description' => 'Rekam pesan tamu + telepon retro, 2 crew standby',
                'price' => 2500000,
            ],
            [
                'name' => 'Audio Guestbook (4 jam)',
                'description' => 'Rekam pesan tamu + telepon retro, 2 crew standby',
                'price' => 3500000,
            ],
            [
                'name' => 'Retro Telephone Supply',
                'description' => 'Unit telepon vintage untuk dekorasi & interaksi tamu',
                'price' => 1500000,
            ],
        ];

        foreach ($audioPackages as $pkg) {
            $gladtocall->packages()->firstOrCreate(
                ['name' => $pkg['name']],
                $pkg
            );
        }
        $this->info('✓ Audio Guestbook packages seeded');

        // Seed Glad Moments (Photobooth)
        $gladmoments = Service::firstOrCreate(
            ['slug' => 'gladmoments'],
            [
                'name' => 'Glad Moments',
                'description' => 'From timeless photobooths to iconic magazine-style setups — setiap foto jadi keepsake.',
                'icon' => '📸',
            ]
        );

        $photoboothPackages = [
            [
                'name' => 'Classic Photobooth — 1 jam',
                'description' => 'Unlimited photo + print, GIF, QR share, 2 crew standby',
                'price' => 1500000,
            ],
            [
                'name' => 'Classic Photobooth — 3 jam',
                'description' => 'Unlimited photo + print, GIF, QR share, 2 crew standby',
                'price' => 2600000,
            ],
            [
                'name' => 'Magazine Photobooth (4-sided) — 1 jam',
                'description' => 'Layout 230×200×200cm, custom overlay, boomerang, flashdisk',
                'price' => 2000000,
            ],
            [
                'name' => 'Magazine Photobooth (4-sided) — 3 jam',
                'description' => 'Layout 230×200×200cm, free transport Bandung, 2 crew',
                'price' => 3000000,
            ],
            [
                'name' => 'Magazine Photobooth Lite (1-sided) — 1 jam',
                'description' => 'Layout 160×200cm, custom overlay, boomerang',
                'price' => 1650000,
            ],
            [
                'name' => 'Magazine Photobooth Lite (1-sided) — 3 jam',
                'description' => 'Layout 160×200cm, free transport Bandung, 2 crew',
                'price' => 2700000,
            ],
            [
                'name' => 'Magazine Booth Only — 1-sided (160×200cm)',
                'description' => 'Booth tanpa crew standby, deposit 600k, max 6 jam',
                'price' => 1000000,
            ],
            [
                'name' => 'Magazine Booth Only — 4-sided (230×200cm)',
                'description' => 'Booth tanpa crew standby, deposit 600k, max 6 jam',
                'price' => 1800000,
            ],
        ];

        foreach ($photoboothPackages as $pkg) {
            $gladmoments->packages()->firstOrCreate(
                ['name' => $pkg['name']],
                $pkg
            );
        }
        $this->info('✓ Photobooth packages seeded');

        // Seed Bundle
        $bundle = Service::firstOrCreate(
            ['slug' => 'bundle'],
            [
                'name' => 'Bundle PhotoBooth + Audio Guestbook',
                'description' => 'Kombinasi Glad Moments photobooth & Glad to Call audio guestbook untuk event lengkap.',
                'icon' => '✨',
            ]
        );

        $bundlePackages = [
            [
                'name' => 'Bundle Classic + Audio (2 jam)',
                'description' => 'Classic photobooth 3 jam + audio guestbook 2 jam',
                'price' => 4500000,
            ],
            [
                'name' => 'Bundle Magazine + Audio (4 jam)',
                'description' => 'Magazine photobooth 3 jam + audio guestbook 4 jam',
                'price' => 5800000,
            ],
            [
                'name' => 'Bundle Premium Full Day',
                'description' => 'Magazine photobooth 3 jam + audio guestbook 4 jam + retro telephone',
                'price' => 6500000,
            ],
        ];

        foreach ($bundlePackages as $pkg) {
            $bundle->packages()->firstOrCreate(
                ['name' => $pkg['name']],
                $pkg
            );
        }
        $this->info('✓ Bundle packages seeded');

        $this->info('');
        $this->info('✅ All packages seeded successfully!');
        $this->info('');
        $this->info('Summary:');
        $this->info('  - Audio Guestbook: 3 packages');
        $this->info('  - Photobooth: 8 packages');
        $this->info('  - Bundle: 3 packages');
    }
}
