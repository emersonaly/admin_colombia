<?php

use Faker\Generator as Faker;

$factory->define(App\UnidadMedida::class, function (Faker $faker) {
    return [
        'user_id'=> 1,
        'descripcion'=> $faker->word,
        'status'=> 1
    ];
});
