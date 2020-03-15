<?php

use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = "
  	        INSERT INTO `servicios` (`id`, `nombre`) VALUES
      			(1, 'EQUIPAMIENTO DE MÓDULO'),
      			(2, 'RESPALDO ENERGÉTICO'),
      			(3, 'DESARMES'),
      			(4, 'SUMINISTRO Y CONFIGURACIÓN PC'),
      			(5, 'REPARACIÓN CÁMARAS'),
      			(6, 'MANTENCIÓN'),
      			(7, 'VENTAS'),
      			(8, 'SERVIDORES'),
      			(9, 'SISTEMA DE MONITOREO'),
      			(10, 'REPARACIONES');
  		  ";
		    DB::select($sql);
    }
}
