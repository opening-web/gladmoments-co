<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('promos', function (Blueprint $table) {
            if (!Schema::hasColumn('promos', 'caption')) {
                $table->string('caption')->nullable()->after('title');
            }
            if (!Schema::hasColumn('promos', 'image_path')) {
                $table->string('image_path')->nullable()->after('caption');
            }
            if (!Schema::hasColumn('promos', 'cta_text')) {
                $table->string('cta_text')->default('Lihat Promo')->after('image_path');
            }
            if (!Schema::hasColumn('promos', 'cta_url')) {
                $table->string('cta_url')->nullable()->after('cta_text');
            }
            if (!Schema::hasColumn('promos', 'cta_target')) {
                $table->string('cta_target')->default('_self')->after('cta_url');
            }
            if (!Schema::hasColumn('promos', 'updated_at')) {
                $table->timestamp('updated_at')->nullable()->after('created_at');
            }
        });
    }

    public function down()
    {
        Schema::table('promos', function (Blueprint $table) {
            if (Schema::hasColumn('promos', 'caption')) {
                $table->dropColumn('caption');
            }
            if (Schema::hasColumn('promos', 'image_path')) {
                $table->dropColumn('image_path');
            }
            if (Schema::hasColumn('promos', 'cta_text')) {
                $table->dropColumn('cta_text');
            }
            if (Schema::hasColumn('promos', 'cta_url')) {
                $table->dropColumn('cta_url');
            }
            if (Schema::hasColumn('promos', 'cta_target')) {
                $table->dropColumn('cta_target');
            }
            if (Schema::hasColumn('promos', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
        });
    }
};
