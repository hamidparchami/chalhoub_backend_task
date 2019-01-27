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

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'id' => \Ramsey\Uuid\Uuid::uuid1(),
        'title' => $faker->title,
        'abstract'      => $faker->realText(500),
        'description'   => $faker->text,
        'image_url'     => $faker->imageUrl($width = 640, $height = 480),
        'price'         => $faker->randomNumber(3),
        'stock'         => $faker->randomNumber(2),
    ];
});
