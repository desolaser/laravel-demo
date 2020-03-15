<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// add
use Illuminate\Support\Facades\DB;

class CreatePreciosEmpresaProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = " 
            create procedure sp_precios_empresas(in empresaId int)
            BEGIN
                insert into precios_empresas (id, empresa_id,servicio_id ,producto_id, precio)
                select null, empresaId, servicio_id, id, precio from productos;
            END
            ";
        
        DB::connection()->getPdo()->exec($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $sql = "DROP procedure IF EXISTS sp_precios_empresas;";
        DB::connection()->getPdo()->exec($sql);
    }
}