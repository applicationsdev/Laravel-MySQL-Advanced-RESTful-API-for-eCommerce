<?php

use Faker\Generator as Faker;
use App\User;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        
        'photo' => $faker->imageUrl($width = 500, $height = 500),
        'address_line1' => $faker->streetAddress,
        'address_line2' => $faker->country,
        'country_code' => $faker->areaCode,
        'postal_code' => $faker->postcode,
        'tel' => $faker->phoneNumber,
        
        'verify_token' => User::createVerifyToken(),
        'state' => $faker->randomElement([
            Config::get('customConstants.user.state.is_not_verified'),
            Config::get('customConstants.user.state.is_client'),
            Config::get('customConstants.user.state.is_merchant'),
            Config::get('customConstants.user.state.is_moderator'),
        ]),
        
        'remember_token' => str_random(10),
    ];
});
