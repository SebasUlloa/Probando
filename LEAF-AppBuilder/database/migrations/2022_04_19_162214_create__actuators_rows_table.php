<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActuatorsRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actuatorsRows', function (Blueprint $table) {
            $table->id('actuatorsrowsId')->autoIncrement();
            $table->primary('actuatorsrowsId');
            $table->foreign('actuatorId')->references('actuatorId')->on('actuators');
            $table->foreign('rowId')->references('rowId')->on('rows');
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
        Schema::dropIfExists('_actuators_rows');
    }
}
