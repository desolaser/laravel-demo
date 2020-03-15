<?php

use Faker\Generator as Faker;
use App\Empresa;

$factory->define(Empresa::class, function (Faker $faker) {
    return [
        'nombre' => $faker->company,
        'iniciales' => $faker->regexify('[A-Za-z0-9]{2}'),
        'giro' => $faker->text(30),
        'rut' => $faker->ean8,
        'razon_social' => $faker->text(30),
        'direccion' => $faker->text(30),
        'comuna' => $faker->state,
        'ciudad' => $faker->city,
        'contacto' => $faker->text(30),
        'saldo' => 0,
    ];
});
