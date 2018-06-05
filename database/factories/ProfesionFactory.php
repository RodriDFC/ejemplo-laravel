<?php

use Faker\Generator as Faker;

$factory->define(App\Profesion::class, function (Faker $faker) {
    return [
        'titulo'=>$faker->sentences(2,false)
    ];
});
