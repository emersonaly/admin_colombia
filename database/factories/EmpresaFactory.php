<?php

use Faker\Generator as Faker;

$factory->define(App\Empresa::class, function (Faker $faker) {
    return [
        'user_id'=> function (array $post) {
            return factory(App\User::class)->create()->id;
        },
        'nit'=> $faker->ean8,
        'razon_social'=>$faker->name,
        'direccion'=>$faker->address,
        'correo'=>$faker->email,
        'telefono_principal'=>$faker->e164PhoneNumber,
        'telefono_segundario'=>$faker->e164PhoneNumber,
        'sucursal'=>$faker->cityPrefix,
    ];
});
