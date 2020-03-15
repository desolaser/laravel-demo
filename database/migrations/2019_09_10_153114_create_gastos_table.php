<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('trabajo_id')->unsigned();
            $table->string('nombre');
            $table->bigInteger('gasto');
            $table->string('numero_boleta');
            $table->string('tipo');
            $table->date('fecha');

            $table->foreign('trabajo_id')
                ->references('id')
                ->on('trabajos');

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
    }
}
