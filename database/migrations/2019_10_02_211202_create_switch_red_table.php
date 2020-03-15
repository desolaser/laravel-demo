<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSwitchRedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('switch_red', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('serial');
            $table->string('marca');
            $table->string('modelo');
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
        Schema::dropIfExists('switch_red');
    }
}
