<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTable([
            'servicios',
            'categorias',
            'productos',
            'empresas',
            'precios_empresas',
            'contactos',
            'users',
            'cotizaciones',
            'det_cotizaciones',
            // ??? TRUNCATE ES PARA ELIMINAR LOS DATOS DE LA TABLA
        ]);

        $this->call([
            ServicioSeeder::class,
            CategoriaSeeder::class,
            ProductoSeeder::class,
            EmpresaSeeder::class,
            ContactoSeeder::class,
            UserSeeder::class,
            CotizacionSeeder::class,
            DetCotizacionSeeder::class,
        ]);
    }

    protected function truncateTable(array $tables)
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        foreach ($tables as $table) {
        	DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
