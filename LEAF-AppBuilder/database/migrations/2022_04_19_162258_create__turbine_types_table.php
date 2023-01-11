<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurbineTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turbineTypes', function (Blueprint $table) {
            $table->id('turbineTypesId')->autoIncrement();
            $table->primary('turbineTypesId');
            $table->integer('turbineTypes');
            $table->foreign('actuatorId')->references('actuatorId')->on('actuators');
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
        Schema::dropIfExists('turbineTypes');
    }
}
