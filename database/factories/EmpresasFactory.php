<?php

use Faker\Generator as Faker;
use App\Empresa;

$factory->define(Empresa::class, function (Faker $faker) {
    $faker->addProvider(new Faker\Provider\en_US\Address($faker));
    $faker->addProvider(new Faker\Provider\en_US\Company($faker));
    return [
        'nombre' => $faker->company,
        'iniciales' => $faker->word,
        'giro' => $faker->text(),
        'rut' => $faker->text(),
        'razon_social' => $faker->text(),
        'direccion' => $faker->text(),
        'comuna' => $faker->text(),
        'ciudad' => $faker->city,
        'contacto'=> $faker->text(),
    ];
});
