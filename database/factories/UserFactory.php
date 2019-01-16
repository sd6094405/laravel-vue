<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => 'eyJpdiI6Ik1ERXdNakF6TURRd05UQTJNRGN3T0E9PSIsInZhbHVlIjoiV2dtdWlWZVpSYmVyZ0tuY0NQWnZxZz09In0=', // secret
        'remember_token' => str_random(10),
    ];
});
