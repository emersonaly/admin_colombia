<?php

use Faker\Generator as Faker;

$factory->define(App\Impuesto::class, function (Faker $faker) {
    return [
        'user_id'=>  function (array $post) {
            return factory(App\User::class)->create()->id;
        },
        'descripcion'=>  $faker->randomDigit,
        'status'=> 1
    ];
});
