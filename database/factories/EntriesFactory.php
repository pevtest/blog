<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entry;
use Faker\Generator as Faker;
use App\User;

$factory->define(Entry::class, function (Faker $faker) {
    return [
        'user_id'=>User::All()->random()->id,
        'title'=>$faker->sentence(10,true),
        'content'=>$faker->text(800),
    ];
});
