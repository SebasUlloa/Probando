<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sectionRows', function (Blueprint $table) {
            $table->id('sectionRowsId')->autoIncrement();
            $table->primary('sectionRowsId');
            $table->integer('sectionNumber');
            $table->foreign('productsId')->references('productsId')->on('products');
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
        Schema::dropIfExists('sectionRows');
    }
}
