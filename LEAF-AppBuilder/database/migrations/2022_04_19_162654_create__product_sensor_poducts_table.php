<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSensorPoductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productSensorProducts', function (Blueprint $table) {
            $table->id('productSensorProductsId')->autoIncrement();
            $table->primary('productSensorProductsId');
            $table->foreign('sensorId')->references('sensorId')->on('sensors');
            $table->foreign('productsId')->references('productsId')->on('products');
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
        Schema::dropIfExists('productSensorProducts');
    }
}
