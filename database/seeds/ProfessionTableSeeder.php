<?php

use Carbon\Carbon;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;
use Illuminate\Support\Facades\DB;

class ProfessionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        // DB::table('professions')->truncate();
        $tags = [
            [
                'profession_name'                  => 'Teacher',
            ],
            [
                'profession_name'                  => 'Accountant',
            ],
            [
                'profession_name'                  => 'Engineer',
            ],
             [
                'profession_name'                  => 'Physician',
            ],
            [
                'profession_name'                  => 'Technician',
            ],
            [
                'profession_name'                  => 'Pharmacist',
            ],
            [
                'profession_name'                  => 'Psychologist',
            ],
            [
                'profession_name'                  => 'Architect',
            ],
            [
                'profession_name'                  => 'Lawyer',
            ],
            [
                'profession_name'                  => 'Veterinarian',
            ],
            [
                'profession_name'                  => 'Dentist',
            ],
            [
                'profession_name'                  => 'Scientist',
            ],
            [
                'profession_name'                  => 'Mechanic',
            ],
            [
                'profession_name'                  => 'Laborer',
            ],
            [
                'profession_name'                  => 'Surveyor',
            ],
            [
                'profession_name'                  => 'Plumber',
            ],
            [
                'profession_name'                  => 'Biomedical Engineer',
            ],
            [
                'profession_name'                  => 'Police officer',
            ],
            [
                'profession_name'                  => 'Dental hygienist',
            ],
            [
                'profession_name'                  => 'Firefighter',
            ],
            [
                'profession_name'                  => 'Geologist',
            ],
            [
                'profession_name'                  => 'Actuary',
            ],
            [
                'profession_name'                  => 'Artist',
            ],
            [
                'profession_name'                  => 'Actor',
            ],
            [
                'profession_name'                  => 'Physiotherapist',
            ],
            [
                'profession_name'                  => 'Radiographer',
            ],
            [
                'profession_name'                  => 'Surgeon',
            ],
            [
                'profession_name'                  => 'Designer',
            ],
            [
                'profession_name'                  => 'Cook',
            ],
            [
                'profession_name'                  => 'Biologist',
            ],
            [
                'profession_name'                  => 'Secretary',
            ],
            [
                'profession_name'                  => 'Judge',
            ],
            [
                'profession_name'                  => 'Graphic Designer',
            ],
            [
                'profession_name'                  => 'Consultant',
            ],
            [
                'profession_name'                  => 'Health professional',
            ],
            [
                'profession_name'                  => 'Waiting staff',
            ],
            [
                'profession_name'                  => 'Estate agent',
            ],
            [
                'profession_name'                  => 'Civil engineer',
            ],
            [
                'profession_name'                  => 'Aviator',
            ],
            [
                'profession_name'                  => 'Optician',
            ],
            [
                'profession_name'                  => 'Broker',
            ],
            [
                'profession_name'                  => 'Landscape architect',
            ],
            [
                'profession_name'                  => 'Economist',
            ],
            [
                'profession_name'                  => 'Doctor',
            ],
            [
                'profession_name'                  => 'Advocate',
            ],
            [
                'profession_name'                  => 'Airline Professional',
            ],
            [
                'profession_name'                  => 'Army Officer',
            ],
            [
                'profession_name'                  => 'Audiologist',
            ],
            [
                'profession_name'                  => 'Banking Professional',
            ],
            [
                'profession_name'                  => 'Driver',
            ],
            [
                'profession_name'                  => 'Data Analyst',
            ],
            [
                'profession_name'                  => 'Clerk',
            ],
            [
                'profession_name'                  => 'Nurse',
            ],
            [
                'profession_name'                  => 'Electrition',
            ],
            [
                'profession_name'                  => 'Plumber',
            ],
            [
                'profession_name'                  => 'Front End Developer',
            ],
            [
                'profession_name'                  => 'Software Professional',
            ],
            [
                'profession_name'                  => 'Tester',
            ],
            [
                'profession_name'                  => 'Back End Developer',
            ],
            [
                'profession_name'                  => 'Designer',
            ],



            
           
        ];

        DB::table('professions')->insert($tags);
    }
}
