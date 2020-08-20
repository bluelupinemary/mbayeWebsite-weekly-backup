<?php

use Illuminate\Database\Seeder;

class FriendshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('friendships')->truncate();
        $friendship = [
            [
                'id'                    => 1,
                'sender_type'           => 'App\Models\Access\User\User',
                'sender_id'             => 4,
                'recipient_type'        => 'App\Models\Access\User\User',
                'recipient_id'          => 3,
                'status'                => 1,
            ],
            [
                'id'                    => 2,
                'sender_type'           => 'App\Models\Access\User\User',
                'sender_id'             => 5,
                'recipient_type'        => 'App\Models\Access\User\User',
                'recipient_id'          => 3,
                'status'                => 1,
            ],
            [
                'id'                    => 3,
                'sender_type'           => 'App\Models\Access\User\User',
                'sender_id'             => 6,
                'recipient_type'        => 'App\Models\Access\User\User',
                'recipient_id'          => 3,
                'status'                => 1,
            ],
            [
                'id'                    => 4,
                'sender_type'           => 'App\Models\Access\User\User',
                'sender_id'             => 7,
                'recipient_type'        => 'App\Models\Access\User\User',
                'recipient_id'          => 3,
                'status'                => 1,
            ],
            [
                'id'                    => 5,
                'sender_type'           => 'App\Models\Access\User\User',
                'sender_id'             => 8,
                'recipient_type'        => 'App\Models\Access\User\User',
                'recipient_id'          => 3,
                'status'                => 1,
            ],
            [
                'id'                    => 6,
                'sender_type'           => 'App\Models\Access\User\User',
                'sender_id'             => 9,
                'recipient_type'        => 'App\Models\Access\User\User',
                'recipient_id'          => 3,
                'status'                => 1,
            ],
            [
                'id'                    => 7,
                'sender_type'           => 'App\Models\Access\User\User',
                'sender_id'             => 10,
                'recipient_type'        => 'App\Models\Access\User\User',
                'recipient_id'          => 3,
                'status'                => 1,
            ],
        ];

        DB::table('friendships')->insert($friendship);
    }
}