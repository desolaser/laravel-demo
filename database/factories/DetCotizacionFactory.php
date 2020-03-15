<?php

use Faker\Generator as Faker;
use DetCotizacion;

$factory->define(DetCotizacion::class, function (Faker $faker) {
    $cotizacion = App\Cotizacion::pluck('id')->toArray();
    $servicio = App\Servicio::pluck('id')->toArray();
    $producto = App\Producto::pluck('id')->toArray();

    $cantidad = $faker->randomDigit;
    return [
        'cotizacion_id' => $faker->randomElement($cotizacion),
        'servicio_id' => $faker->randomElement($servicio),
        'producto_id' => $faker->randomElement($producto),
        'cantidad' => $cantidad,
        'precio' => $producto->precio,
        'total' => $cantidad * $producto->precio,
    ];
});
