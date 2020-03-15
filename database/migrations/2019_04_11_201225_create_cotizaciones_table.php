<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('empresa_id')->unsigned();
            $table->bigInteger('centro_id')->unsigned();
            $table->bigInteger('contacto_id')->unsigned();
            $table->bigInteger('factura_id')->unsigned()->nullable();
            $table->text('nota')->nullable();
            $table->integer('viatico')->default(0);
            $table->integer('sumatoria');
            $table->integer('descuento');
            $table->integer('subtotal');
            $table->integer('impuesto');
            $table->integer('total');
            $table->string('status');
            $table->string('responsable');

            $table->timestamps();

            $table->foreign('empresa_id')
                ->references('id')
                ->on('empresas');

            $table->foreign('centro_id')
                ->references('id')
                ->on('centros');

            $table->foreign('contacto_id')
                ->references('id')
                ->on('contactos');

            $table->foreign('factura_id')
                ->references('id')
                ->on('facturas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temps_cotizacion');
        Schema::dropIfExists('archivo_cotizaciones');
        Schema::dropIfExists('det_cotizaciones');
        Schema::dropIfExists('seguimiento');
        Schema::dropIfExists('trabajos');
        Schema::dropIfExists('materiales');
        Schema::dropIfExists('cotizaciones');
    }
}
