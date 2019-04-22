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

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'subject_id'=>rand(1,3),
        'username'=>$faker->name.rand(100,9999),
        'openid'=>$faker->uuid,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'nickname'=>$faker->name,
        'avatar'=>$faker->url,
        'country'=>$faker->country,
        'gender'=>rand(0,2),
        'password' => $faker->password,
        'status'=>1,
        'point'=>rand(100,99999),
        'expires'=>$faker->dateTime,
        'remember_token' => str_random(10),
    ];
});
