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
        Schema::table('business_client_bonuses', function (Blueprint $table) {
            $table->dateTime('activation_bonus_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('deactivation_bonus_date')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_client_bonuses', function (Blueprint $table) {
            $table->dropColumn(['activation_bonus_date', 'deactivation_bonus_date']);
        });
    }
};
