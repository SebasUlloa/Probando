<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActuatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actuators', function (Blueprint $table) {
            $table->id('actuatorsId')->autoIncrement();
            $table->integer('actuatorModelId');
            $table->text('name');
            $table->integer('actuatorType');
            $table->primary('actuatorsId');
            $table->foreign('machineId')->references('machineId')->on('machineData');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_actuators');
    }
}
