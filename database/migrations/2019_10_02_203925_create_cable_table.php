<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cable', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipo_cable');
            $table->string('longitud');
            $table->integer('cantidad');
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
        Schema::dropIfExists('cable');
    }
}
