<?php

use Faker\Generator as Faker;
use App\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'image_thumbnail' => $faker->imageUrl($width = 500, $height = 500),
        'description_short' => $faker->text($maxNbChars = 90),
        
        'status' => $faker->randomElement([
            Config::get('customConstants.category.status.is_not_active'),
            Config::get('customConstants.category.status.is_active'),
        ]),
    ];
});
