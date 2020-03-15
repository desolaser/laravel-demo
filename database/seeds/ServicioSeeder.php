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
			(2, 'EQUIPAMIENTO DE PONTÓN'),
			(3, 'EQUIPAMIENTO IPAD'),
			(4, 'EQUIPAMIENTO DOMO'),
			(5, 'RESPALDO ENERGÉTICO'),
			(6, 'EQUIPAMIENTO MÓDULO LIFT UP'),
			(7, 'DESARMES'),
			(8, 'SUMINISTRO Y CONFIGURACIÓN PC'),
			(9, 'REPARACIÓN CÁMARAS SUBMARINAS'),
			(10, 'MANTENCIÓN DE CÁMARAS SUBMARINAS'),
			(11, 'PRODUCTOS VENTAS AL DETALLE'),
			(12, 'CAMBIO DE PONTÓN'),
			(13, 'REVISIÓN DE SISTEMA DE MONITOREO'),
			(14, 'SISTEMA DE MONITOREO JAULAS CIRCULARES'),
			(15, 'REPARACIÓN CARRO MONITOR'),
			(16, 'INSTALACION SISTEMA DE SEGURIDAD');
		";

		DB::select($sql);

    }
}
