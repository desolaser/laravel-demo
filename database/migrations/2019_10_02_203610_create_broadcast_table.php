<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBroadcastTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('broadcast', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('serial');
            $table->string('modelo');
            $table->string('usuario');
            $table->string('clave');
            $table->string('serial_p2p');
            $table->string('ip');
            $table->string('mac_address');
            $table->string('nombre');
            $table->string('firmware');
            $table->string('backup');
            $table->string('marca_dvr');
            $table->string('modelo_dvr');
            $table->bigInteger('numero_produccion');
            $table->bigInteger('numero_camaras');
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
        Schema::dropIfExists('broadcast');
    }
}
