<?php

use Faker\Generator as Faker;

$factory->define(App\Cliente::class, function (Faker $faker) {
    return [
        'nombre_completo' => $faker->name,
        'carnet_identidad'=>$faker->numberBetween(10000,100000),
        'direccion' => $faker->address,
        'telefono' =>$faker->phoneNumber,
        'sexo'=> $faker->randomElement(['femenino','masculino'])
    ];
});
