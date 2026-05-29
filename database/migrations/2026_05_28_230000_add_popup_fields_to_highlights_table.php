<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('highlights', function (Blueprint $table) {
            $table->boolean('is_popup')->default(false)->after('is_active');
            $table->string('popup_url')->nullable()->after('is_popup');
            $table->string('popup_button_text')->nullable()->after('popup_url');
            $table->string('popup_target')->default('_self')->after('popup_button_text');
            $table->unsignedInteger('popup_priority')->default(0)->after('popup_target');
        });
    }

    public function down(): void
    {
        Schema::table('highlights', function (Blueprint $table) {
            $table->dropColumn(['is_popup', 'popup_url', 'popup_button_text', 'popup_target', 'popup_priority']);
        });
    }
};
