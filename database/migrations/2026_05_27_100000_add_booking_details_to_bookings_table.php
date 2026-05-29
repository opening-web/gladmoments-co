<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('booking_type')->default('photobooth')->after('package_id');
            $table->string('event_time')->nullable()->after('event_date');
            $table->string('event_name')->nullable()->after('event_time');
            $table->string('event_location')->nullable()->after('event_name');
            $table->string('payment_proof')->nullable()->after('down_payment');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'booking_type',
                'event_time',
                'event_name',
                'event_location',
                'payment_proof',
            ]);
        });
    }
};
