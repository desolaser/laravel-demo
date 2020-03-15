<?php

use Illuminate\Database\Seeder;

class MovimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = "
        INSERT INTO `movimientos` (`id`, `fecha`, `monto`, `saldo`, `empresa_id`, `factura_id`, `transferencia_id`, `created_at`, `updated_at`) VALUES
        (1, '2020-12-24', 100000, 100000, 1, 1, NULL, '2018-01-10 00:53:46', '2018-01-10 00:53:46'),
        (2, '2020-12-25', -100000, 0, 1, NULL, 1, '2018-01-10 00:53:46', '2018-01-10 00:53:46'),
        (3, '2020-12-26', 200000, 200000, 1, 2, NULL, '2018-01-10 00:53:46', '2018-01-10 00:53:46'),
        (4, '2020-12-27', -200000, 0, 1, NULL, 2, '2018-01-10 00:53:46', '2018-01-10 00:53:46');
        ";
        DB::select($sql);
    }
}
