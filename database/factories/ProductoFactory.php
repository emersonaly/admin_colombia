<?php

use Faker\Generator as Faker;

$factory->define(App\Producto::class, function (Faker $faker) {
    return [
        'user_id'=> 1,
        'codigo_barrra'=> $faker->ean13,
        'descripcion'=> $faker->text(60),
        'existen'=> $faker->randomDigitNotNull(2),
        'existencia_minima'=> 5,
        'costo'=>  $faker->numberBetween(10,150),
        'costo_dolar'=> $faker->numberBetween(10,150),
        'precio_venta1'=> $faker->numberBetween(10,150),
        'precio_venta2'=> $faker->numberBetween(10,150),
        'precio_venta_dolar1'=> $faker->numberBetween(10,150),
        'precio_venta_dolar2'=> $faker->numberBetween(10,150),
        'unimed_id'=> function () {
            return factory(App\UnidadMedida::class)->create()->id;
        },
        'servicio'=> rand(0,1),
        'empre_id'=> function () {
            return factory(App\Empresa::class)->create()->id;
        },
        'porcentaje_descuento'=> $faker->numberBetween(10,150),
        'impuestos_id'=>  function () {
            return factory(App\Impuesto::class)->create()->id;
        },
    ];
});
