<?php

use Illuminate\Database\Seeder;

class TransferenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = "
        INSERT INTO `transferencias` (`id`, `tipo_pago`, `monto`, `fecha`, `banco`, `numero_cheque`, `codigo_transferencia`, `created_at`, `updated_at`) VALUES
        (1, 'TRANSFERENCIA', 100000, '2020-12-24', 'BANCO ESTADO', 123214124, '123214124', '2018-01-10 00:53:46', '2018-01-10 00:53:46'),
        (2, 'TRANSFERENCIA', 100000, '2020-12-25', 'BANCO ESTADO', 123213213, '123214124', '2018-01-10 00:53:46', '2018-01-10 00:53:46'),
        (3, 'TRANSFERENCIA', 100000, '2020-12-26', 'BANCO ESTADO', 523432112, '123214124', '2018-01-10 00:53:46', '2018-01-10 00:53:46'),
        (4, 'TRANSFERENCIA', 100000, '2020-12-27', 'BANCO ESTADO', 764524221, '123214124', '2018-01-10 00:53:46', '2018-01-10 00:53:46');
        ";
        DB::select($sql);
    }
}
