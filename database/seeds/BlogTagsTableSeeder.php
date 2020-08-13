<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_tags')->truncate();
        $tags = [
            [
                'name'                  => 'Films',
                'code'                  => 'films',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => 'Sports',
                'code'                  => 'sports',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => 'Mountains and Seas',
                'code'                  => 'mountains_and_seas',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => 'Music',
                'code'                  => 'music',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => 'Politics',
                'code'                  => 'politics',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => 'Family and Friends',
                'code'                  => 'family_and_friends',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => 'Travel',
                'code'                  => 'travel',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => 'Designs',
                'code'                  => 'designs',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => 'Careers',
                'code'                  => 'careers',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ]
        ];

        DB::table('blog_tags')->insert($tags);
    }
}
