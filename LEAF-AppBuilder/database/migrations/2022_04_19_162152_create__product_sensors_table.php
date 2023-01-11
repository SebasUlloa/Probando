<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productSensors', function (Blueprint $table) {
            $table->id('productSensorsId')->autoIncrement();
            $table->primary('productSensorsId');
            $table->integer('instanceId');
            $table->integer('isMuted')->default(0);
            $table->text('version');
            $table->integer('reporICS')->default(0);
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
        Schema::dropIfExists('productSensors');
    }
}
