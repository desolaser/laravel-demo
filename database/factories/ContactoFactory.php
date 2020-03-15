<?php

use Faker\Generator as Faker;
use App\Contacto;

$factory->define(Contacto::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'movil' => $faker->phoneNumber,
        'oficina' => $faker->phoneNumber,
    ];
});
