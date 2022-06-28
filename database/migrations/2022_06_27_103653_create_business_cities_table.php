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
        Schema::create('business_cities', function (Blueprint $table) {
            $table->foreignId('business_id');
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete("cascade")->onUpdate("cascade");

            $table->foreignId('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_cities');
    }
};
