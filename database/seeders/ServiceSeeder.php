<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $gladtocall = Service::create([
            'name' => 'Audio Guestbook', 
            'slug' => 'gladtocall',
            'description' => 'Audio guestbook berkonsep telepon retro, menghadirkan pengalaman nostalgia dan interaksi tamu yang tak terlupakan.',
            'icon' => '🎙️',
        ]);

        $gladtocall->packages()->createMany([
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
        ]);

        $gladmoments = Service::create([
            'name' => 'Glad Moments',
            'slug' => 'gladmoments',
            'description' => 'From timeless photobooths to iconic magazine-style setups — setiap foto jadi keepsake.',
            'icon' => '📸',
        ]);

        $gladmoments->packages()->createMany([
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
        ]);

        $bundle = Service::create([
            'name' => 'Bundle PhotoBooth + Audio Guestbook',
            'slug' => 'bundle',
            'description' => 'Kombinasi Glad Moments photobooth & Glad to Call audio guestbook untuk event lengkap.',
            'icon' => '✨',
        ]);

        $bundle->packages()->createMany([
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
        ]);

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
    }
}