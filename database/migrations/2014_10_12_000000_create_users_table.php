<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('role');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            //$table->unsignedInteger('id_tipo_usuario');
            //$table->foreign('id_tipo_usuario')->references('id')->('tipo_usuario');
            $table->rememberToken();
            $table->timestamps();
        })
        
        /*  //HACER CON NUEVA MIGRATIONS
            Schema::create('tipo_usuario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('usuario')->unique();
            $table->timestamps();
        })


        */
        
        ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
