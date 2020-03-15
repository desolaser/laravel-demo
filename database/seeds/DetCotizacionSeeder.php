<?php

use Illuminate\Database\Seeder;

class DetCotizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\DetCotizacion::class, 40)->create();
    }
}
