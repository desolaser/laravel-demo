<?php

use Faker\Generator as Faker;
use App\Contacto;

$factory->define(Contacto::class, function (Faker $faker) {
    $empresas = App\Empresa::pluck('id')->toArray();
    return [
        'empresa_id' => $faker->randomElement($empresas),
        'nombre' => $faker->name,
        'cargo' => $faker->jobTitle,
        'zona' => $faker->state,
        'email' => $faker->unique()->safeEmail,
        'movil' => $faker->phoneNumber,
        'oficina' => $faker->address,
    ];
});
