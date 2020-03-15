<?php

use Illuminate\Database\Seeder;

class ContactoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = "
        INSERT INTO `contactos`
        (`id`, `empresa_id`, `centro_id`, `nombre`, `cargo`, `zona`, `email`, `movil`, `oficina`, `created_at`, `updated_at`) VALUES
        (1, 1, 77, 'ALEJANDRO OYARZO','JEFE','3','alejandro.oyarzo@blumar.com', '+56 9 61427298' ,'MELINKA','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (2, 5, 76, 'ALEJANDRO OYARZO','JEFE','3','alejandro.oyarzo@blumar.com', '+56 9 61427298' ,'MELINKA','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (3, 5, 75, 'NELSON PEREZ','JEFE',4,'nelson.perez@blumar.com', '+56412269400' ,'PUNTA ARENAX','2019-07-29 19:41:30','2019-07-29 19:41:30'),
        (4, 1, 11, 'FRANCISCO SUBIABRE','JEFE',2,'Francisco.Subiabre@cermaq.com', '+56(9)40023518' ,'QUENCHI','2019-07-29 19:41:30','2019-07-29 19:41:30'),;
        ";

        DB::select($sql);

    }
}
