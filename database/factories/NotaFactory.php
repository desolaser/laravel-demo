<?php

use Faker\Generator as Faker;

$factory->define(App\Nota::class, function (Faker $faker) {
    return [
        'detalle' => $faker->paragraph(mt_rand(30, 100)),
    ];
});
