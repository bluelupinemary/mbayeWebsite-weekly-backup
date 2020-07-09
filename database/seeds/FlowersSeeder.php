<?php

use Illuminate\Database\Seeder;

class FlowersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('flowers')->truncate();
        $tags = [
            [
                'id'                    => 1,
                'codename'              => '1Protea',
                'flower_name'           => 'Protea',
            ],
            [
                'id'                    => 55,
                'codename'              => '55BlueEyedGrass',
                'flower_name'           => 'BlueEyedGrass',
            ],
            [
                'id'                    => 64,
                'codename'              => '64Laelia',
                'flower_name'           => 'Laelia',
            ],
            [
                'id'                    => 121,
                'codename'              => '121SolanumIncanum',
                'flower_name'           => 'SolanumIncanum',
            ],
            [
                'id'                    => 133,
                'codename'              => '133Rafflesia',
                'flower_name'           => 'Rafflesia',
            ],
            [
                'id'                    => 177,
                'codename'              => '177Bougainvillea',
                'flower_name'           => 'Bougainvillea',
            ],
        ];

        DB::table('flowers')->insert($tags);
    }
}
