<?php

use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = "
	        INSERT INTO `empresas` (`id`, `nombre`, `iniciales`, `giro`, `rut`, `razon_social`, `direccion`, `comuna`, `ciudad`, `contacto`) VALUES
    			(1, 'EMPRESA 1', 'E1', 'GIRO 1', '11.111.111-1', 'RAZÓN 1', '1', '1', '1', '1'),
    			(2, 'EMPRESA 2', 'E2', 'GIRO 2', '22.222.222-2', 'RAZÓN 2', '2', '2', '2', '2'),
    			(3, 'EMPRESA 3', 'E3', 'GIRO 3', '33.333.333-3', 'RAZÓN 3', '3', '3', '3', '3'),
    			(4, 'EMPRESA 4', 'E4', 'GIRO 4', '44.444.444-4', 'RAZÓN 4', '4', '4', '4', '4'),
    			(5, 'EMPRESA 5', 'E5', 'GIRO 5', '55.555.555-5', 'RAZÓN 5', '5', '5', '5', '5'),
    			(6, 'EMPRESA 6', 'E6', 'GIRO 6', '66.666.666-6', 'RAZÓN 6', '6', '6', '6', '6');
        ";

		DB::select($sql);
    }
}
