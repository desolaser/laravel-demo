<?php

use Illuminate\Database\Seeder;


// add
use Illuminate\Support\Facades\DB;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //tipo_usuario = DB::table('tipo_usuario')->select('id')->take(1)->get();

        factory(User::class)->create([
        	'name' => 'demo',
        	'email' => 'demo@microwave.cl',
        	'role' => 'SUPERUSUARIO',
            'password' => bcrypt('demonio'),
            //'id_tipo_usuario' => $tipo_usuario->id
        ]);

        factory(User::class)->create([
        	'name' => 'Indhira Medina',
        	'email' => 'indhira@microwave.cl',
        	'role' => 'DIGITADOR',
            'password' => bcrypt('yindy1354'),
            //'id_tipo_usuario' => $tipo_usuario->id
        ]);

        factory(User::class)->create([
        	'name' => 'Osdaly Pacheco',
        	'email' => 'osdaly@microwave.cl',
        	'role' => 'DIGITADOR',
            'password' => bcrypt('osdaly2102'),
            //'id_tipo_usuario' => $tipo_usuario->id
        ]);

        factory(User::class)->create([
        	'name' => 'Ivette Bastidas',
        	'email' => 'ivette@microwave.cl',
        	'role' => 'SUPERVISOR',
            'password' => bcrypt('zeus2203'),
            //'id_tipo_usuario' => $tipo_usuario->id
        ]);

        factory(User::class)->create([
        	'name' => 'Juan Arturo Ojeda',
        	'email' => 'arturojeda@microwave.cl',
        	'role' => 'SUPERVISOR',
            'password' => bcrypt('12345678'),
            //'id_tipo_usuario' => $tipo_usuario->id
        ]);

        factory(User::class)->create([
        	'name' => 'Juan Pablo Loyola',
        	'email' => 'juanpablo.loyola@ulagos.cl',
        	'role' => 'SUPERUSUARIO',
            'password' => bcrypt('12345678'),
            //'id_tipo_usuario' => $tipo_usuario->id
        ]);

        /*
            BD::table('tipo_usuario')->insert([
                'usuario' => Administrador,

            ]);

            BD::table('tipo_usuario')->insert([
                'usuario' => Digitador,

            ]);

            BD::table('tipo_usuario')->insert([
                'usuario' => SuperUsuario,

            ]);

            
        */
    }
}
