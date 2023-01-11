<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcusActuatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ecusActuators', function (Blueprint $table) {
            $table->id('ecusActuatorsId')->autoIncrement();
            $table->primary('ecusActuatorsId');
            $table->foreign('ecuId')->references('ecuId')->on('ecus');
            $table->foreign('actuatorsId')->references('actuatorsId')->on('actuators');
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
        Schema::dropIfExists('ecusActuators');
    }
}
