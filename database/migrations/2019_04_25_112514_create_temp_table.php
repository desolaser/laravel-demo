<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_unique');
            $table->bigInteger('servicio_id')->unsigned();
            $table->bigInteger('det_cotizacion_id')->unsigned()->nullable();
            $table->bigInteger('producto_id')->unsigned();
            $table->integer('cantidad');
            $table->integer('precio');
            $table->integer('total');
            $table->timestamps();

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
        Schema::dropIfExists('temps');
    }
}
