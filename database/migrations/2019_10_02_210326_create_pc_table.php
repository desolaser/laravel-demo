<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('serial');
            $table->string('modelo');
            $table->string('tipo');
            $table->string('placa_madre');
            $table->string('fuente_poder');
            $table->string('procesador');
            $table->string('teclado');
            $table->string('mouse');
            $table->string('ram');
            $table->string('disco_duro');
            $table->string('tarjeta_video');
            $table->string('wifi');
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
        Schema::dropIfExists('pc');
    }
}
