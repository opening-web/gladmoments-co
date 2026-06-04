<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get all services with URL encoded descriptions
        $services = DB::table('services')->get();

        foreach ($services as $service) {
            if ($service->description && strpos($service->description, '%') !== false) {
                // Decode the URL encoded description
                $decoded = urldecode($service->description);
                
                // Update with decoded value
                DB::table('services')
                    ->where('id', $service->id)
                    ->update(['description' => $decoded]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cannot reliably reverse URL encoding, so we skip
    }
};
