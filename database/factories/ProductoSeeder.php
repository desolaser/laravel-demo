<?php

use Faker\Generator as Faker;
use App\Producto;

$factory->define(Producto::class, function (Faker $faker) {
    $servicio = App\Servicio::pluck('id')->toArray();
    $categoria = App\Categoria::pluck('id')->toArray();

    $status = ["MONTO", "UNIDAD", "METROS"];
    return [
        'servicio_id' => $faker->randomElement($servicio),
        'categoria_id' => $faker->randomElement($categoria),
        'nombre' => $faker->name,
        'unidad' => $faker->randomElement($status),
        'precio' => $faker->numberBetween(1000, 10000);
    ];
});
