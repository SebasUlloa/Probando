<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('productsId')->autoIncrement();
            $table->primary('productsId');
            $table->text('name');
            $table->integer('sections');
            $table->integer('actuatorsCombType');
            $table->text('enable');
            $table->integer('productsType');
            $table->integer('main')->default(0);
            $table->foreign('plantingTypeId')->references('plantingTypeId')->on('plantingTypes');
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
        Schema::dropIfExists('products');
    }
}
