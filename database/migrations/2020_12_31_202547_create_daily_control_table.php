<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyControlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_control', function (Blueprint $table) {
            $table->id();
            $table->string('cedula');
            $table->string('placa');
            $table->string('nombre_chofer');
            $table->string('nombre_carnet_circulacion');
            $table->integer('rubro_id');
            $table->integer('tipo_combustible');
            $table->float('litros');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_control');
    }
}
