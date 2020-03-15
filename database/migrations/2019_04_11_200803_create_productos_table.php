<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('servicio_id')->unsigned();
            $table->bigInteger('categoria_id')->unsigned();
            $table->string('nombre');
            $table->string('unidad');
            $table->integer('precio');
            $table->string('archivado')->default('FALSE');

            $table->foreign('servicio_id')
                ->references('id')
                ->on('servicios');

            $table->foreign('categoria_id')
                ->references('id')
                ->on('categorias');

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
        Schema::dropIfExists('productos');
    }
}
