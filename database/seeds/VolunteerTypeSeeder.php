<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VolunteerTypeSeeder extends Seeder {

    public function run()
    {
        DB::table('volunteer_types')->delete();

        DB::table('volunteer_types')->insert(array('type' => 'High School Student'));
        DB::table('volunteer_types')->insert(array('type' => 'College Student'));
        DB::table('volunteer_types')->insert(array('type' => 'Middle School Student'));
        DB::table('volunteer_types')->insert(array('type' => 'Employee of Company'));
        DB::table('volunteer_types')->insert(array('type' => 'Court Mandated'));
        DB::table('volunteer_types')->insert(array('type' => 'Religious Institution'));
        DB::table('volunteer_types')->insert(array('type' => 'Non-Affilidated Volunteer'));

    }

}


?>