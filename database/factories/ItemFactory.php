<?php

use Faker\Generator as Faker;
use App\Item;
use App\User;
use App\Category;

// NOTE: To simplify testing, this factory generates only Items with
// 'status'='is_available' and they belong to Categories with 'status'='is_active'

$factory->define(Item::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'image_thumbnail' => $faker->imageUrl($width = 500, $height = 500),
        'description_short' => $faker->text($maxNbChars = 200),
        
        'available_qty' => $faker->numberBetween($min = 1, $max = 20),
        'catalog_price' => $faker->randomElement([79.90, 99.90, 120.00, 158.00, 285.00, 349.00, 490.00]),
        
        'status' => Config::get('customConstants.item.status.is_available'),
        
        'category_id' => Category::all()->only(Category::isActive())->random()->id,
        'merchant_id' => User::all()->only(User::isMerchant())->random()->id,
    ];
});
