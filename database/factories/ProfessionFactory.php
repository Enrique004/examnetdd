<?php

use Faker\Generator as Faker;

$factory->define(App\Profession::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'description' => $faker->text(),
        'education_level' => $faker->sentence(3),
        'salary' => $faker->numberBetween(0,5000),
        'sector' => $faker->sentence(3),
        'experience_required' => $faker->numberBetween(0,6)
    ];
});
