<?php

use Faker\Generator as Faker;
use App\DetCotizacion;

$factory->define(DetCotizacion::class, function (Faker $faker) {
    $cotizaciones = App\Cotizacion::pluck('id')->toArray();
    $servicios = App\Servicio::pluck('id')->toArray();

    $producto = App\Producto::all()->random();
    $cantidad = $faker->randomDigit;
    return [
        'cotizacion_id' => $faker->randomElement($cotizaciones),
        'servicio_id' => $faker->randomElement($servicios),
        'producto_id' => $producto->id,
        'cantidad' => $cantidad,
        'precio' => $producto->precio,
        'total' => $cantidad * $producto->precio,
    ];
});
