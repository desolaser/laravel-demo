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
            'centros',
            'contactos',
            'users',
            'cotizaciones',
            'det_cotizaciones',
            'facturas',
            'movimientos',
            'transferencias',
           // 'seguimiento_cotizaciones',
            //tipo_usuario, ??? TRUNCATE ES PARA ELIMINAR LOS DATOS DE LA TABLA
        ]);

        $this->call([
            ServicioSeeder::class,
            CategoriaSeeder::class,
            ProductoSeeder::class,
            EmpresaSeeder::class,
            CentroSeeder::class,
            ContactoSeeder::class,
            UserSeeder::class,
            TransferenciaSeeder::class,
            FacturaSeeder::class,
            MovimientoSeeder::class,
            CotizacionSeeder::class,
            DetCotizacionSeeder::class,
          //  SeguimientoSeeder::class,
            //TipoUsuarioSeeder::class,
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
