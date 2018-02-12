<?php

use Faker\Generator as Faker;
use App\Item;
use App\Category;
use App\User;

// To simplify testing, this factory generates only Items with 'available_qty' > 0,
// 'status'='is_available' and they belong to Categories with 'status'='is_active'

$factory->define(Item::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'image_thumbnail' => $faker->imageUrl($width = 500, $height = 500),
        'description_short' => $faker->text($maxNbChars = 150),
        
        'available_qty' => $faker->numberBetween($min = 2, $max = 20),
        'catalog_price' => $faker->randomElement([79.90, 99.90, 120.00, 158.00, 285.00, 349.00, 490.00]),
        
        'status' => Config::get('customConstants.item.status.is_available'),
        
        'category_id' => Category::all()
            ->where('status', '=', Config::get('customConstants.category.status.is_active'))
            ->random(1)->id,
        
        'merchant_id' => User::all()
            ->where('state', '=', Config::get('customConstants.user.state.is_merchant'))
            ->random(1)->id,
    ];
});
