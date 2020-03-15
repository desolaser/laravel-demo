<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasAiTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = " 
            CREATE TRIGGER empresas_ai AFTER INSERT ON empresas
                FOR EACH ROW BEGIN
                call sp_precios_empresas(new.id); 
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
        $sql = "DROP TRIGGER IF EXISTS empresas_ai;";
        DB::connection()->getPdo()->exec($sql);
    }
}
