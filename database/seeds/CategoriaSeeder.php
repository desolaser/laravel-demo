<?php

use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$sql = "
	    	INSERT INTO `categorias` (`id`, `nombre`) VALUES
			(1, 'MANO DE OBRA'),
			(2, 'MATERIALES E INSUMOS'),
			(3, 'PRODUCTO EIP'),
			(4, 'PRODUCTO CV'),
			(5, 'GASTOS TERRENO/LOGÍSTICA')
		";

		DB::select($sql);	
    }
}
