<?php

use Faker\Generator as Faker;
use App\Cotizacion;

$factory->define(Cotizacion::class, function (Faker $faker) {
    $empresas = App\Empresa::pluck('id')->toArray();
    $contacto = App\Contacto::pluck('id')->toArray();

    $viatico = $faker->numberBetween(10000, 100000);
    $sumatoria = $faker->numberBetween(10000, 100000);
    $descuento = $faker->numberBetween(10000, 100000);
    $subtotal = $viatico + $sumatoria - $descuento;
    $impuesto = $subtotal * 0.19;
    $total = $subtotal + $impuesto;

    return [
  		'empresa_id' => $faker->randomElement($empresas),
  		'contacto_id' => $faker->randomElement($contacto),
  		'factura_id' => NULL,
     	'nota' => $faker->text(10),
  		'viatico' => $viatico,
  		'sumatoria' => $sumatoria,
  		'descuento' => $descuento,
  		'subtotal' => $subtotal,
  		'impuesto' => $impuesto,
  		'status' => "EN_DISEÑO",
  		'total' => $total,
      'responsable' => $faker->name
    ];
});
