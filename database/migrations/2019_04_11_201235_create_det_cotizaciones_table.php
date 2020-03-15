<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetCotizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_cotizaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cotizacion_id')->unsigned();
            $table->bigInteger('servicio_id')->unsigned();
            $table->bigInteger('producto_id')->unsigned();
            $table->integer('cantidad');
            $table->integer('precio');
            $table->integer('total');
            $table->timestamps();

            $table->foreign('cotizacion_id')
                ->references('id')
                ->on('cotizaciones');

            $table->foreign('servicio_id')
                ->references('id')
                ->on('servicios');

            $table->foreign('producto_id')
                ->references('id')
                ->on('productos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('det_cotizaciones');
    }
}
