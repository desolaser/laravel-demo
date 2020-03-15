<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreciosEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precios_empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('empresa_id')->unsigned();
            $table->bigInteger('servicio_id')->unsigned();
            $table->bigInteger('producto_id')->unsigned();
            $table->integer('precio');
            
            $table->foreign('empresa_id')
                ->references('id')
                ->on('empresas');

            $table->foreign('servicio_id')
                ->references('id')
                ->on('servicios');

            $table->foreign('producto_id')
                ->references('id')
                ->on('productos');

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
        Schema::dropIfExists('precios_empresas');
    }
}
