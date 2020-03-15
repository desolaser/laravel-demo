<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempsFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temps_factura', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_unique');
            $table->bigInteger('factura_id')->unsigned();

            $table->foreign('factura_id')
                ->references('id')
                ->on('facturas');

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
        Schema::dropIfExists('temps_factura');
    }
}
