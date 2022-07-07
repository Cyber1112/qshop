<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_schedules', function (Blueprint $table) {
            $table->enum('work_schedule', ['five', 'six', 'seven']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_schedules', function (Blueprint $table) {
            $table->dropColumn('work_schedule');
        });
    }
};
