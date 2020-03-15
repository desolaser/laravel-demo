<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('fecha');
            $table->bigInteger('monto');
            $table->bigInteger('saldo');
            $table->bigInteger('empresa_id')->unsigned();
            $table->bigInteger('factura_id')->unsigned()->nullable();
            $table->bigInteger('transferencia_id')->unsigned()->nullable();

            $table->foreign('empresa_id')
                ->references('id')
                ->on('empresas');

            $table->foreign('factura_id')
                ->references('id')
                ->on('facturas');

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
        Schema::dropIfExists('movimientos');
    }
}
