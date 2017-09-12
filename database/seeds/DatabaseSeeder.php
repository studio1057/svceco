<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
//use database\seeds\GroupTypeSeeder;

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

        $this->call('GroupTypeSeeder');
        $this->call('GroupSeeder');
        $this->call('VolunteerTypeSeeder');
        $this->call('StatesSeeder');
        $this->call('EventCategorySeeder');
        $this->call('OrganizationCategorySeeder');
        $this->call('ScreenFormSeeder');
    }
}

class EventCategorySeeder extends Seeder {

    public function run()
    {
        DB::table('event_category')->delete();


        DB::table('event_category')->insert(array('type' => 'Clothing'));
        DB::table('event_category')->insert(array('type' => 'Walk / Run'));
        DB::table('event_category')->insert(array('type' => 'Event Setup'));
        DB::table('event_category')->insert(array('type' => 'Food Drive'));
        DB::table('event_category')->insert(array('type' => 'Supply Drive'));
        DB::table('event_category')->insert(array('type' => 'Blood Drive'));
        DB::table('event_category')->insert(array('type' => 'Soup Kitcken'));
        DB::table('event_category')->insert(array('type' => 'Clean Up'));
        DB::table('event_category')->insert(array('type' => 'Hospital'));
        DB::table('event_category')->insert(array('type' => 'Camp'));
        DB::table('event_category')->insert(array('type' => 'Other'));
    }

}


class OrganizationCategorySeeder extends Seeder {

    public function run()
    {
        DB::table('organization_category')->delete();


        DB::table('organization_category')->insert(array('type' => 'Animals'));
        DB::table('organization_category')->insert(array('type' => 'Arts,Culture,Humanities'));
        DB::table('organization_category')->insert(array('type' => 'Community Development'));
        DB::table('organization_category')->insert(array('type' => 'Education'));
        DB::table('organization_category')->insert(array('type' => 'Environment'));
        DB::table('organization_category')->insert(array('type' => 'Health'));
        DB::table('organization_category')->insert(array('type' => 'Human+Civil Rights'));
        DB::table('organization_category')->insert(array('type' => 'Humans Services'));
        DB::table('organization_category')->insert(array('type' => 'International'));
        DB::table('organization_category')->insert(array('type' => 'Religion'));

    }

}

class ScreenFormSeeder extends Seeder {

    public function run()
    {
        DB::table('screenform')->delete();


        DB::table('screenform')->insert(array('form' => '
        <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div id="formwrap">
                    <h2 class="nohd">Join event</h2>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="greensteps">
                                <span>|</span>PERSONAL INFORMATION
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb15 col-md-6 col-sm-6">
                            <input placeholder="First Name" type="text" name="firstname">
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <input placeholder="Last Name" type="text" name="lastname">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <input placeholder="Address" type="text" name="address">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <input placeholder="City , State & Zip" type="text" name="location">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <input placeholder="Country / Parish" type="text" name="country">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb15 col-md-6 col-sm-6">
                            <input placeholder="Home Phone" type="text" name="homephone">
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <input placeholder="Work Phone" type="text" name="workphone">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <input placeholder="Email Address" type="text" name="email">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="chkbox">
                                <label class="checkbox" for="checkbox2">
                                <input data-toggle="checkbox" id="checkbox2" type="checkbox" value="1" name="ofage">I am 18 years & Older</label>
                            </div>

                            <p class="smtxt">( *If you are under 18 years of
                            age, you must have a parent / legal guardian sign
                            this application form. )</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb15 col-md-6 col-sm-6">
                            <input placeholder="Emergency Contact" type="text" name="emcontact">
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <input placeholder="Emergency Phone" type="text" name="emphone">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <input placeholder="Relationship to You" type="text" name="relation">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <label class="mg12">Are you a victim/survivor of a
                            drunk driving crash?</label>

                            <div class="mb15 chkbox">
                                <label class="checkbox" for="checkbox11">
                                <input data-toggle="checkbox" id="checkbox11" type="checkbox" value="1" name="survivor_yes"><span class="wid">yes</span></label>
                            </div>

                            <div class="chkbox">
                                <label class="checkbox" for=
                                "checkbox12">
                                <input data-toggle="checkbox" id="checkbox12" type="checkbox"  value="1" name="survivor_no"><span class="wid">No</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb15 col-md-6 col-sm-6">
                            <input placeholder="If yes , date of crash" type="text" name="dateofcrash">
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <input placeholder="Date of Criminal disposition"  type="text" name="dateofdisposition">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="greensteps">
                                <span>||</span>EMPLOYMENT
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <label class="mg12">Emploment :</label>

                            <div class="mb15 chkbox">
                                <label class="checkbox" for="checkbox13">
                                <input data-toggle="checkbox" id="checkbox13" type="checkbox" value="1" name="fulltime"><span class="wid">Full
                                time</span></label>
                            </div>

                            <div class="mb15 chkbox">
                                <label class="checkbox" for=
                                "checkbox14"><input data-toggle=
                                "checkbox" id="checkbox14" type="checkbox"
                                value="1" name="parttime"><span class="wid">Part
                                time</span></label>
                            </div>

                            <div class="mb15 chkbox">
                                <label class="checkbox" for=
                                "checkbox14"><input data-toggle=
                                "checkbox" id="checkbox14" type="checkbox"
                                value="1" name="retired"><span class=
                                "wid">Retired</span></label>
                            </div>

                            <div class="chkbox">
                                <label class="checkbox" for=
                                "checkbox15"><input data-toggle=
                                "checkbox" id="checkbox15" type="checkbox"
                                value="1" name="unemployed"><span class=
                                "wid">Unemployed</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <input placeholder="Current Occupation" type=
                            "text" name="occupation">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <textarea placeholder="Work Experience :" name="experience">
                            </textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <input placeholder="Current Occupation" type=
                            "text" name="current_occupation">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="greensteps">
                                <span>|||</span>LANGUAGE
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <label>Do you speak any languages other than
                            English?</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <input placeholder="Language" type="text" name="language">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <label class="mg12">Conversational Fluency:</label>

                            <div class="mb15 chkbox">
                                <label class="checkbox" for=
                                "checkbox16"><input data-toggle=
                                "checkbox" id="checkbox16" type="checkbox"
                                value="1" name="fair"><span class="wid">Fair</span></label>
                            </div>

                            <div class="mb15 chkbox">
                                <label class="checkbox" for=
                                "checkbox17"><input data-toggle=
                                "checkbox" id="checkbox17" type="checkbox"
                                value="1" name="good"><span class="wid">Good</span></label>
                            </div>

                            <div class="chkbox">
                                <label class="checkbox" for=
                                "checkbox18"><input data-toggle=
                                "checkbox" id="checkbox18" type="checkbox"
                                value="1" name="excellent"><span class=
                                "wid">Excellent</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <input placeholder="Language" type="text" name="language_2">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <label class="mg12">Conversational Fluency:</label>

                            <div class="mb15 chkbox">
                                <label class="checkbox" for=
                                "checkbox19"><input data-toggle=
                                "checkbox" id="checkbox19" type="checkbox"
                                value="1" name="fair_2"> <span class="wid">Fair</span></label>
                            </div>

                            <div class="mb15 chkbox">
                                <label class="checkbox" for=
                                "checkbox20"><input data-toggle=
                                "checkbox" id="checkbox20" type="checkbox"
                                value="1" name="good_2"><span class="wid">Good</span></label>
                            </div>

                            <div class="chkbox">
                                <label class="checkbox" for=
                                "checkbox21"><input data-toggle=
                                "checkbox" id="checkbox21" type="checkbox"
                                value="1" name="excellent_2"><span class=
                                "wid">Excellent</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="greensteps">
                                <span>|V</span>AREA OF INTEREST
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <label>Please indicate 1st, 2nd, and 3rd choice
                            from the list below.</label>

                            <p class="smtxt">(Please note: Some volunteer
                            positions/programs may not be available in all
                            communities.)</p>
                        </div>

                        <div class="col-md-12 col-sm-12 chkboxwrap">
                            <div class="chkbox">
                                <label class="checkbox" for=
                                "checkbox23"><input data-toggle=
                                "checkbox" id="checkbox23" type="checkbox"
                                value="1" name="victimservices"><span class="wid">Victim
                                Services</span></label>
                            </div>

                            <div class="chkbox">
                                <label class="checkbox" for=
                                "checkbox24"><input data-toggle=
                                "checkbox" id="checkbox24" type="checkbox"
                                value="1" name="fundraising"><span class=
                                "wid">Fundraising</span></label>
                            </div>

                            <div class="chkbox">
                                <label class="checkbox" for=
                                "checkbox25"><input data-toggle=
                                "checkbox" id="checkbox25" type="checkbox"
                                value="1" name="administration"><span class=
                                "wid">Administration</span></label>
                            </div>

                            <div class="chkbox">
                                <label class="checkbox" for=
                                "checkbox26"><input data-toggle=
                                "checkbox" id="checkbox26" type="checkbox"
                                value="1" name="policy"><span class="wid">Public
                                Policy</span></label>
                            </div>

                            <div class="chkbox">
                                <label class="checkbox" for=
                                "checkbox27"><input data-toggle=
                                "checkbox" id="checkbox27" type="checkbox"
                                value="1" name="programs"><span class=
                                "wid">Programs</span></label>
                            </div>

                            <div class="chkbox">
                                <label class="checkbox" for=
                                "checkbox28"><input data-toggle=
                                "checkbox" id="checkbox28" type="checkbox"
                                value="1" name="marketing"> <span class=
                                "wid">Marketing/Communications</span></label>
                            </div>

                            <div class="chkbox">
                                <label class="checkbox" for=
                                "checkbox29"><input data-toggle=
                                "checkbox" id="checkbox29" type="checkbox"
                                value="1" name="fiscal"><span class="wid">Fiscal
                                Management</span></label>
                            </div>

                            <div class="chkbox">
                                <label class="checkbox" for=
                                "checkbox30"><input data-toggle=
                                "checkbox" id="checkbox30" type="checkbox"
                                value="1" name="leadership"><span class=
                                "wid">Leadership</span></label>
                            </div>

                            <div class="chkbox">
                                <label class="checkbox" for=
                                "checkbox31"><input data-toggle=
                                "checkbox" id="checkbox31" type="checkbox"
                                value="1" name="other"><span class="wid">Other</span></label>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <p class="smtxt">Pleasentville is under no
                            obligation to accept my service. Pleasentville
                            reserves the right to reject any volunteer
                            application, which Pleasentville, in its sole
                            judgment, determines, is not in the best interest
                            of Pleasentville.</p>

                            <p class="smtxt nomar">I affirm that I have read
                            and understand the application and its terms and
                            that the statements and information provided in
                            this application are true and correct.</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <input placeholder="Date" type="text" name="signedate">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <input placeholder="Your Name" type="text" name="yourname">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <p class="smtxt nomar" style="font-style: italic">
                            At Pleasentville, we are committed to providing
                            equal opportunities for employment or volunteering
                            to all qualified applicants, regardless of race,
                            creed, color, religion, sex, sexual orientation,
                            age, national origin, marital status, citizenship
                            status, veteran status, or disability.</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <input type="submit" value="Submit">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        '));


    }

}