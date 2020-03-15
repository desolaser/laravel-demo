<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajos', function (Blueprint $table) {            
            $table->bigIncrements('id');
            $table->bigInteger('cotizacion_id')->unsigned();
            $table->string('motivo');
            $table->string('OT');
            $table->string('GD');
            $table->date('fecha_ingreso');
            $table->date('fecha_retorno');

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
        Schema::dropIfExists('gastos');
        Schema::dropIfExists('trabajos');
    }
}
