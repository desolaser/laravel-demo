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
			  (2, 'INSUMOS'),
			  (3, 'MATERIALES')
		  ";
		  DB::select($sql);
    }
}
