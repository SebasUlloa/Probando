<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->id('sensorsId')->autoIncrement();
            $table->primary('sensorsId');
            $table->integer('instanceId');
            $table->integer('isMuted')->default(0);
            $table->text('version');
            $table->integer('isCan')->default(0);
            $table->integer('sensorType')->default(0);
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
        Schema::dropIfExists('sensors');
    }
}
