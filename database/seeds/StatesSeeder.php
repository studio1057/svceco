<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StatesSeeder extends Seeder {

    public function run()
    {
        DB::table('states')->delete();

        DB::table('states')->insert(
            array(
                array('state' => 'Alabama', 'abbreviation' => 'AL'),
                array('state' => 'Alaska', 'abbreviation' => 'AK'),
                array('state' => 'Arizona', 'abbreviation' => 'AZ'),
                array('state' => 'Arkansas', 'abbreviation' => 'AR'),
                array('state' => 'California', 'abbreviation' => 'CA'),
                array('state' => 'Colorado', 'abbreviation' => 'CO'),
                array('state' => 'Connecticut', 'abbreviation' => 'CT'),
                array('state' => 'Delaware', 'abbreviation' => 'DE'),
                array('state' => 'District of Columbia', 'abbreviation' => 'DC'),
                array('state' => 'Florida', 'abbreviation' => 'FL'),
                array('state' => 'Georgia', 'abbreviation' => 'GA'),
                array('state' => 'Hawaii', 'abbreviation' => 'HI'),
                array('state' => 'Idaho', 'abbreviation' => 'ID'),
                array('state' => 'Illinois', 'abbreviation' => 'IL'),
                array('state' => 'Indiana', 'abbreviation' => 'IN'),
                array('state' => 'Iowa', 'abbreviation' => 'IA'),
                array('state' => 'Kansas', 'abbreviation' => 'KS'),
                array('state' => 'Kentucky', 'abbreviation' => 'KY'),
                array('state' => 'Louisiana', 'abbreviation' => 'LA'),
                array('state' => 'Maine', 'abbreviation' => 'ME'),
                array('state' => 'Maryland', 'abbreviation' => 'MD'),
                array('state' => 'Massachusetts', 'abbreviation' => 'MA'),
                array('state' => 'Michigan', 'abbreviation' => 'MI'),
                array('state' => 'Minnesota', 'abbreviation' => 'MN'),
                array('state' => 'Mississippi', 'abbreviation' => 'MS'),
                array('state' => 'Missouri', 'abbreviation' => 'MO'),
                array('state' => 'Montana', 'abbreviation' => 'MT'),
                array('state' => 'Nebraska', 'abbreviation' => 'NE'),
                array('state' => 'Nevada', 'abbreviation' => 'NV'),
                array('state' => 'New Hampshire', 'abbreviation' => 'NH'),
                array('state' => 'New Jersey', 'abbreviation' => 'NJ'),
                array('state' => 'New Mexico', 'abbreviation' => 'NM'),
                array('state' => 'New York', 'abbreviation' => 'NY'),
                array('state' => 'North Carolina', 'abbreviation' => 'NC'),
                array('state' => 'North Dakota', 'abbreviation' => 'ND'),
                array('state' => 'Ohio', 'abbreviation' => 'OH'),
                array('state' => 'Oklahoma', 'abbreviation' => 'OK'),
                array('state' => 'Oregon', 'abbreviation' => 'OR'),
                array('state' => 'Pennsylvania', 'abbreviation' => 'PA'),
                array('state' => 'Rhode Island', 'abbreviation' => 'RI'),
                array('state' => 'South Carolina', 'abbreviation' => 'SC'),
                array('state' => 'South Dakota', 'abbreviation' => 'SD'),
                array('state' => 'Tennessee', 'abbreviation' => 'TN'),
                array('state' => 'Texas', 'abbreviation' => 'TX'),
                array('state' => 'Utah', 'abbreviation' => 'UT'),
                array('state' => 'Vermont', 'abbreviation' => 'VT'),
                array('state' => 'Virginia', 'abbreviation' => 'VA'),
                array('state' => 'Washington', 'abbreviation' => 'WA'),
                array('state' => 'West Virginia', 'abbreviation' => 'WV'),
                array('state' => 'Wisconsin', 'abbreviation' => 'WI'),
                array('state' => 'Wyoming', 'abbreviation' => 'WY')
            ));


    }

}


?>