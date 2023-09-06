<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('temperatures', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float('sensor_01');
            $table->float('sensor_02');
            $table->float('sensor_03');
            $table->float('sensor_04');
            $table->float('sensor_05');
            $table->float('sensor_06');
            $table->float('sensor_07');
            $table->float('sensor_08');
            $table->float('sensor_09');
            $table->float('sensor_10');
            $table->float('sensor_11');
            $table->float('sensor_12');
            $table->float('sensor_13');
            $table->float('sensor_14');
            $table->float('sensor_15');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temperatures');
    }
};
