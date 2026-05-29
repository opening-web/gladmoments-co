<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('portfolios')) {
            return;
        }

        Schema::table('portfolios', function (Blueprint $table) {
            if (! Schema::hasColumn('portfolios', 'image_path')) {
                $table->string('image_path')->nullable()->after('title');
            }
        });

        if (Schema::hasColumn('portfolios', 'image') && DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE `portfolios` MODIFY `image` VARCHAR(255) NULL');
        }

        DB::table('portfolios')
            ->whereNull('image_path')
            ->whereNotNull('image')
            ->update(['image_path' => DB::raw('`image`')]);

        DB::table('portfolios')
            ->whereNull('image')
            ->whereNotNull('image_path')
            ->update(['image' => DB::raw('`image_path`')]);
    }

    public function down(): void
    {
        //
    }
};
