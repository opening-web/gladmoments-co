<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('highlights')) {
            Schema::create('highlights', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('category')->nullable();
                $table->string('caption')->nullable();
                $table->string('image_path')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('testimonials')) {
            Schema::create('testimonials', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('event')->nullable();
                $table->text('message');
                $table->unsignedTinyInteger('rating')->default(5);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (Schema::hasTable('portfolios')) {
            Schema::table('portfolios', function (Blueprint $table) {
                if (! Schema::hasColumn('portfolios', 'image_path')) {
                    $table->string('image_path')->nullable()->after('title');
                }
            });
        }
    }

    public function down(): void
    {
        // Keep data safe on rollback.
    }
};

