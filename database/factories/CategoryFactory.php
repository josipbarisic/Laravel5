<?php

use Faker\Generator as Faker;
use App\models\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'slug' => $faker->unique()->slug
    ];
});
