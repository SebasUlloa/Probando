<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActuatorsSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actuatorsSensors', function (Blueprint $table) {
            $table->id('actuatorsSensorsId')->autoIncrement();
            $table->primary('actuatorsSensorsId');
            $table->foreign('actuatorsId')->references('actuatorsId')->on('actuators');
            $table->foreign('sensorsId')->references('sensorsId')->on('sensors');
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
        Schema::dropIfExists('actuatorsSensors');
    }
}
