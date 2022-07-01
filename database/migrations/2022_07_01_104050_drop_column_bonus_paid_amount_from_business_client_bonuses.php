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
            $table->dropColumn(['bonus_amount', 'paid_amount']);
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
            $table->integer('paid_amount')->default(0);
            $table->integer('bonus_amount')->default(0);
        });
    }
};
