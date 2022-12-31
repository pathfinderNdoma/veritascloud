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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('authorization_code');
            $table->string('device_type');
            $table->string('device_name');
            $table->string('on_state');
            $table->string('off_state');
            $table->string('low_state');
            $table->string('medium_state');
            $table->string('high_state');
            $table->string('veryHigh_state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
};
