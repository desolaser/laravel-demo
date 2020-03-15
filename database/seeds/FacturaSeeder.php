<?php

use Illuminate\Database\Seeder;

class FacturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = "
        INSERT INTO `facturas` (`id`, `rut`, `razon_social`, `fecha`, `resumen`, `monto`, `transferencia_id`, `created_at`, `updated_at`) VALUES
        (1, '11111111-1', 'asd1', '2020-12-24', 'ASD', 100000, NULL, '2020-01-08 00:53:46', '2018-01-10 00:53:46'),
        (2, '22222222-1', 'asd2', '2020-12-25', 'ASD', 200000, NULL, '2020-01-08 00:53:46', '2018-01-10 00:53:46'),
        (3, '33333333-1', 'asd3', '2020-12-26', 'ASD', 300000, NULL, '2020-01-08 00:53:46', '2018-01-10 00:53:46'),
        (4, '44444444-1', 'asd4', '2020-12-27', 'ASD', 400000, NULL, '2020-01-08 00:53:46', '2018-01-10 00:53:46');
        ";
        DB::select($sql);
    }
}
