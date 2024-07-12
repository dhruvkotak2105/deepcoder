<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'thumb_image' => $faker->imageUrl(),
        'name' => $faker->word,
        'description' => $faker->sentence,
        'price' => $faker->randomFloat(2, 10, 100),
        'category_id' => function () {
            return factory(App\Category::class)->create()->id;
        },
    ];
});