<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangeDoubleLineConfigToMachineDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actuatorSections', function (Blueprint $table) {
            $table->id('actuatorSectionsId')->autoIncrement();
            $table->primary('actuatorSectionsId');
            $table->integer('sectionNumber'); // DEBERIA SER FK
            $table->foreign('productsId')->references('productsId')->on('products');
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
        Schema::dropIfExists('actuatorSections');
    }
}
