<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class SupplementServicesSeeder extends Seeder
{
    public function run(): void
    {
        Service::firstOrCreate(
            ['slug' => 'bundle'],
            [
                'name' => 'Bundle PhotoBooth + Audio Guestbook',
                'description' => 'Kombinasi Glad Moments photobooth & Glad to Call audio guestbook untuk event lengkap.',
                'icon' => '✨',
            ]
        )->packages()->firstOrCreate(
            ['name' => 'Bundle Classic + Audio (2 jam)'],
            ['description' => 'Classic photobooth 3 jam + audio guestbook 2 jam', 'price' => 4500000]
        );

        $bundle = Service::where('slug', 'bundle')->first();
        if ($bundle) {
            $bundle->packages()->firstOrCreate(
                ['name' => 'Bundle Magazine + Audio (4 jam)'],
                ['description' => 'Magazine photobooth 3 jam + audio guestbook 4 jam', 'price' => 5800000]
            );
            $bundle->packages()->firstOrCreate(
                ['name' => 'Bundle Premium Full Day'],
                ['description' => 'Magazine photobooth 3 jam + audio guestbook 4 jam + retro telephone', 'price' => 6500000]
            );
        }
    }
}
