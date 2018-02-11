<?php

use Faker\Generator as Faker;
use App\OrderItem;

// NOTE: To simplify testing, this factory generates 'qty' range
// only within the "at least" (ensured) available qty of any product

$factory->define(OrderItem::class, function (Faker $faker) {
    return [
        'qty' => $faker->numberBetween($min = 1, $max = 5),
        // to be continued soon in next commits
    ];
});
