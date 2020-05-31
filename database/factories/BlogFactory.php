<?php

use App\Models\Access\User\User;
use App\Models\Blogs\Blog;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Blog::class, function (Faker $faker) {
    $status = [
        'Published',
        'Draft',
        'InActive',
        'Scheduled',
    ];

    return [
        'name'             => Str::random(10),
        'publish_datetime' => $faker->dateTime(),
        'featured_image'   => $faker->image('public/storage/img/blog',400,300, null, false) ,
        'content'          => $faker->paragraph(3),
        'status'           => $status[$faker->numberBetween(0, 3)],
        'created_by'       => '1',
    ];
});
