<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'category_id' => rand(1, 3), //masukan foregnID random dari 1-3
        //dengan data yang sudah ada ditable factory
        'title' => $faker->sentence(),
        'slug' => \Str::slug($faker->sentence()),
        'body' => $faker->paragraph(10) //10 adalah jumlah paragraf
    ];
});
