<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCamaraTable extends Migration
{    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camara', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('serial');
            $table->string('marca');
            $table->string('modelo');
            $table->string('usuario');
            $table->string('clave');
            $table->string('serial_p2p');
            $table->string('ip');
            $table->string('mac_address');
            $table->string('nombre');
            $table->string('firmware');
            $table->string('backup');
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
        Schema::dropIfExists('camara');
    }
}
