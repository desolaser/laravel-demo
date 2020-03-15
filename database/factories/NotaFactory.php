<?php

use Faker\Generator as Faker;

$factory->define(App\Nota::class, function (Faker $faker) {
    return [
        'detalle' => $faker->paragraph(1),
    ];
});
