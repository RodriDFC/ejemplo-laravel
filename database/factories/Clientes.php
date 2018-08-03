<?php

use Faker\Generator as Faker;

/** @var TYPE_NAME $factory */
$factory->define(App\Cliente::class, function (Faker $faker) {
    return [
        'nombre_completo' => $faker->name,
        'carnet_identidad'=>$faker->numberBetween(10000,1000000),
        'direccion' => $faker->address,
        'telefono' =>$faker->phoneNumber,
    ];
});
