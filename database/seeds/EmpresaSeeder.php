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
	        INSERT INTO `empresas` (`id`, `nombre`, `iniciales`,`giro`,`rut`,`razon_social`,`direccion`,`comuna`,`ciudad`,`contacto`) VALUES
			(1, 'CERMAQ', 'CE','1','1','1','1','1','1','1'),
			(2, 'GRANJA MARINA', 'GM','2','2','2','2','2','2','2'),
			(3, 'MOWI', 'MH','3','3','3','3','3','3','3'),
			(4, 'VENTISQUEROS', 'VQ','4','4','4','4','4','4','4'),
			(5, 'BLURIVER', 'BR','5','5','5','5','5','5','5'),
			(6, 'COOKE AQUACULTURE', 'CC','6','6','6','6','6','6','6');
        ";

		DB::select($sql);        
    }
}
