<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        // $this->call(BlogTableSeeder::class);
        $this->call(BlogTagsTableSeeder::class);
        $this->call(AccessTableSeeder::class);
        $this->call(HistoryTypeTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(ModulesTableSeeder::class);
        $this->call(ProfessionTableSeeder::class);
        $this->call(IndustryTableSeeder::class);
        // $this->call(ModulIesTableSeeder::class);
        Model::reguard();
    }
}
