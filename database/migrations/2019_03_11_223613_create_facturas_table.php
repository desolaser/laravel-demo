<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rut');
            $table->string('razon_social');
            $table->date('fecha');
            $table->string('resumen');
            $table->bigInteger('monto');
            $table->bigInteger('numero_factura_sii');
            $table->bigInteger('transferencia_id')->unsigned()->nullable();

            $table->foreign('transferencia_id')
                ->references('id')
                ->on('transferencias');

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
        Schema::dropIfExists('facturas');
    }
}
