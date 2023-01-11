<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRowsOffsetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rowsOffsets', function (Blueprint $table) {
            $table->integer('rowId')->autoIncrement();
            $table->integer('offset');
            $table->primary('rowId');
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
        Schema::dropIfExists('rowsOffsets');
    }
}
