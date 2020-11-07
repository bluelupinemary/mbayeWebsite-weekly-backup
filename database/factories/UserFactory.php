<?php

use App\Models\Access\User\User;
use Faker\Generator;
use Illuminate\Support\Str;

$factory->define(User::class, function (Generator $faker) {
    static $password;

    return [
        'username'         => $faker->name,
        'first_name'         => $faker->name,
        'last_name'         => $faker->name,
        'email'             => $faker->unique()->safeEmail,
        'password'          => $password ?: $password = bcrypt('aszx'),
        'confirmed'          => 1,
        'is_term_accept'    =>1,
        'photo'    =>        'default.png',
        'confirmation_code' => md5(uniqid(mt_rand(), true)),
        'remember_token'    => Str::random(10),
    ];
});

$factory->state(User::class, 'active', function () {
    return [
        'status' => 1,
    ];
});

$factory->state(User::class, 'inactive', function () {
    return [
        'status' => 0,
    ];
});

$factory->state(User::class, 'confirmed', function () {
    return [
        'confirmed' => 1,
    ];
});

$factory->state(User::class, 'unconfirmed', function () {
    return [
        'confirmed' => 0,
    ];
});
