<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachineDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machineData', function (Blueprint $table) {
            $table->id('machineId')->unique();
            $table->string('name', 100);
            $table->text('description');
            $table->integer('rowsQty');
            $table->decimal('rowsFixedDistance');
            $table->integer('doubleLineConfig');
            $table->integer('machineFamilyId');
            $table->primary('machineId');
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
        Schema::dropIfExists('_machine_data');
    }
}
