<?php

use Faker\Generator as Faker;
use App\Order;
use App\User;

$factory->define(Order::class, function (Faker $faker) {
    
    // To simplify testing, in this version I examine the case
    // that only users with state = is_client, are making orders
    $client = User::inRandomOrder()
            ->where('state', '=', Config::get('customConstants.user.state.is_client'))
            ->first();
    
    return [
        // 'value' => 0.00,
        // By migration default will be set to 0.00 & will be fixed in DatabaseSeeder because
        // 1. on purpose I execute OrderFactory before OrderItemFactory
        // 2. some Orders can have more than 1 OrderItems, which is closer to real situation
        
        // 'status' => null,
        // An example of a real-world value could be: 'status' => 'completed',
        // This feature is not examined in current app version & by migration default will be set to null
        
        'client_id' => $client->id,
    ];
});
