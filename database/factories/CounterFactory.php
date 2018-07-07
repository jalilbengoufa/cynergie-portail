<?php

use Faker\Generator as Faker;

$factory->define(App\Counter::class, function (Faker $faker) {
    return [
        'name' => $faker->title,
        'place' => $faker->timezone,
        'modelid' => function () {
            return factory(App\Controller_Model::class)->create();
        }
    ];
});
