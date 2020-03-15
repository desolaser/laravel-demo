<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ap', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('serial');
            $table->string('marca');
            $table->string('modelo');
            $table->string('usuario');
            $table->string('clave');
            $table->string('ssid');
            $table->string('wifi');
            $table->string('ip');
            $table->string('firmware');
            $table->string('backup');
            $table->string('tipo');
            $table->string('tipo_equipo');
            $table->bigInteger('cotizacion_id')->unsigned();

            $table->foreign('cotizacion_id')
                ->references('id')
                ->on('cotizaciones');

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
        Schema::dropIfExists('ap');
    }
}
