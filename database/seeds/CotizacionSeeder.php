<?php

use Illuminate\Database\Seeder;

class CotizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = "
	    	INSERT INTO `cotizaciones` (`id`, `empresa_id`,`centro_id`,`contacto_id`,`nota`,`viatico`, `sumatoria`, `descuento`,`subtotal`,`impuesto`,`total`,`status`,`responsable`,`created_at`,`updated_at`) VALUES
			(1, 5, 75, 1, 'DEJAR EN LA ENTRADA', 23, 6, 11430, 11424, 2171 , 13595, 'EN_DISEÑO', 'demo', '2018-01-10 00:53:46', '2018-01-10 00:53:46'),
			(2, 5, 75, 2, 'DEJAR EN LA ENTRADA', 23, 6, 11430, 11424, 2171 , 13595, 'EN_DISEÑO', 'demo', '2018-02-10 00:53:46', '2018-02-10 00:53:46'),
			(3, 5, 75, 3, 'DEJAR EN LA ENTRADA', 23, 6, 11430, 11424, 2171 , 13595, 'EN_DISEÑO', 'demo', '2018-03-10 00:53:46', '2018-03-10 00:53:46'),
			(4, 5, 75, 4, 'DEJAR EN LA ENTRADA', 23, 6, 11430, 11424, 2171 , 13595, 'EN_DISEÑO', 'demo', '2018-04-10 00:53:46', '2018-04-10 00:53:46'),
			(5, 5, 75, 5, 'DEJAR EN LA ENTRADA', 23, 6, 11430, 11424, 2171 , 13595, 'EN_DISEÑO', 'demo', '2018-05-10 00:53:46', '2018-05-10 00:53:46'),
			(6, 5, 75, 6, 'DEJAR EN LA ENTRADA', 23, 6, 11430, 11424, 2171 , 13595, 'EN_DISEÑO', 'demo', '2018-06-10 00:53:46', '2018-06-10 00:53:46'),
			(7, 5, 75, 7, 'DEJAR EN LA ENTRADA', 23, 6, 11430, 11424, 2171 , 13595, 'EN_DISEÑO', 'demo', '2018-07-10 00:53:46', '2018-07-10 00:53:46'),
			(8, 5, 75, 8, 'DEJAR EN LA ENTRADA', 23, 6, 11430, 11424, 2171 , 13595, 'EN_DISEÑO', 'demo', '2018-08-10 00:53:46', '2018-08-10 00:53:46'),
			(9, 5, 75, 9, 'DEJAR EN LA ENTRADA', 23, 6, 11430, 11424, 2171 , 13595, 'EN_DISEÑO', 'demo', '2019-01-10 00:53:46', '2019-01-10 00:53:46'),
			(10, 5, 75, 10, 'DEJAR EN LA ENTRADA', 23, 6, 11430, 11424, 2171 , 13595, 'OPERACIONES', 'demo', '2019-02-10 00:53:46', '2019-02-10 00:53:46'),
			(11, 5, 75, 11, 'DEJAR EN LA ENTRADA', 23, 6, 11430, 11424, 2171 , 13595, 'OPERACIONES', 'demo', '2019-03-10 00:53:46', '2019-03-10 00:53:46'),
			(12, 5, 75, 12, 'DEJAR EN LA ENTRADA', 23, 6, 11430, 11424, 2171 , 13595, 'OPERACIONES', 'demo', '2019-04-10 00:53:46', '2019-04-10 00:53:46'),
			(13, 5, 75, 13, 'DEJAR EN LA ENTRADA', 23, 6, 11430, 11424, 2171 , 13595, 'OPERACIONES', 'demo', '2019-05-10 00:53:46', '2019-05-10 00:53:46'),
			(14, 5, 75, 14, 'DEJAR EN LA ENTRADA', 23, 6, 11430, 11424, 2171 , 13595, 'OPERACIONES', 'demo', '2019-06-10 00:53:46', '2019-06-10 00:53:46'),
			(15, 5, 75, 15, 'DEJAR EN LA ENTRADA', 23, 6, 11430, 11424, 2171 , 13595, 'OPERACIONES', 'demo', '2019-07-10 00:53:46', '2019-07-10 00:53:46');
		";

		DB::select($sql);	
    }
}
