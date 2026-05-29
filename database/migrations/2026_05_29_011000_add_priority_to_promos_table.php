<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('promos', function (Blueprint $table) {
            if (!Schema::hasColumn('promos', 'priority')) {
                $table->unsignedInteger('priority')->default(0);
            }
        });
    }

    public function down()
    {
        Schema::table('promos', function (Blueprint $table) {
            if (Schema::hasColumn('promos', 'priority')) {
                $table->dropColumn('priority');
            }
        });
    }
};
