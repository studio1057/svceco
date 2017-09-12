<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GroupTypeSeeder extends Seeder {

    public function run()
    {
        DB::table('group_types')->delete();

        DB::table('group_types')->insert(array('type' => 'School'));
        DB::table('group_types')->insert(array('type' => 'Court Mandate'));

    }

}


?>