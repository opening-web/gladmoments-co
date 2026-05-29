<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('services') && ! Schema::hasColumn('services', 'price')) {
            Schema::table('services', function (Blueprint $table) {
                $table->decimal('price', 15, 2)->default(0)->after('slug');
            });
        }

        if (Schema::hasTable('bookings')) {
            Schema::table('bookings', function (Blueprint $table) {
                if (! Schema::hasColumn('bookings', 'booking_type')) {
                    $table->string('booking_type')->default('photobooth')->after('package_id');
                }
                if (! Schema::hasColumn('bookings', 'package_choice')) {
                    $table->string('package_choice')->nullable()->after('package_id');
                }
                if (! Schema::hasColumn('bookings', 'event_time')) {
                    $table->string('event_time', 10)->nullable()->after('event_date');
                }
                if (! Schema::hasColumn('bookings', 'event_name')) {
                    $table->string('event_name')->nullable()->after('event_time');
                }
                if (! Schema::hasColumn('bookings', 'event_location')) {
                    $table->string('event_location', 500)->nullable()->after('event_name');
                }
                if (! Schema::hasColumn('bookings', 'form_details')) {
                    $table->longText('form_details')->nullable()->after('down_payment');
                }
                if (! Schema::hasColumn('bookings', 'updated_by_admin')) {
                    $table->string('updated_by_admin')->nullable()->after('status');
                }
                if (! Schema::hasColumn('bookings', 'last_updated_at')) {
                    $table->timestamp('last_updated_at')->nullable()->after('updated_by_admin');
                }
            });
        }

        if (Schema::hasTable('portfolios') && ! Schema::hasColumn('portfolios', 'image_path')) {
            Schema::table('portfolios', function (Blueprint $table) {
                $table->string('image_path')->nullable()->after('title');
            });
        }

        if (! Schema::hasTable('schedules')) {
            Schema::create('schedules', function (Blueprint $table) {
                $table->id();
                $table->foreignId('service_id')->constrained()->onDelete('cascade');
                $table->date('date');
                $table->string('time');
                $table->string('location');
                $table->enum('status', ['Available', 'Booked', 'Maintenance'])->default('Available');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        // Intentionally left empty to avoid destructive rollback on existing external schema.
    }
};
