<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Crud;
use Faker\Generator as Faker;

$factory->define(Crud::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->name,
        'address' => $faker->name,
    ];
});
