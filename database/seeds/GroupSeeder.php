<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder {

    public function run()
    {
        DB::table('groups')->delete();

        DB::table('groups')->insert(array('name' => 'Volunteer'));
        

    }

}


?>