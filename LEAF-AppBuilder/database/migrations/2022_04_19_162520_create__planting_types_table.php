<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantingTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantingTypes', function (Blueprint $table) {
            $table->id('plantingTypesId')->autoIncrement();
            $table->primary('plantingTypesId');
            $table->text('name');
            $table->integer('doubleLineConfig')->default(0);
            $table->real('rowDistance');
            $table->integer('isActive')->default(0);
            $table->integer('sowingModeType');
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
        Schema::dropIfExists('_planting_types');
    }
}
