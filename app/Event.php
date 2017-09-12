<?php namespace App;

use App\User;
use App\Volunteer;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class Event extends \Eloquent implements SluggableInterface {

    use SluggableTrait;


    protected $table = "event";

    protected $fillable = ['organization_id', 'name', 'slug', 'start_time', 'end_time', "credits", "description", "screening_required", "age_requirement", "org_category", "category", "city",
        "state", "address","zipcode", "phone", "email", "max_users", "status", "attendances_limit"];

    protected $sluggable = array(
        'build_from' => 'name',
        'save_to'    => 'slug',
    );

    public function getDates()
    {
        return ['created_at', 'updated_at', 'start_time', 'end_time'];
    }

    public function organization() {

        return $this->belongsTo('App\Organization');
    }

    public function getMonth($date) {

        $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

        return $months[$date->month-1];
    }
    public function FriendlyDate($date) {

         $year = $date->year;

        $day = (int)$date->day;
        return sprintf("%d %s %d", $day, $this->getMonth($date), $year);
    }

    public function getEventType() {

        $minutes = Carbon::now()->addMinutes(1);



        $EventTypes = Cache::remember('event_category', $minutes, function()
        {
            return DB::table('event_category')->select('id', 'type')->get();
            //return DB::table('groups')->select('id', 'name')->get()->skip(1);
        });

       return $EventTypes[$this->category - 1]->type;
    }

    public function getAttending() {

        return DB::table('attendance')->where('event_id', '=', $this->id)->count();
    }

    public function getStartDate() {
        $dt = Carbon::createFromTimestamp( $this->start_date->timestamp );
        $dt->timezone = $this->getTimeZoneFromState($this->state);

    }

    public function getStartTime(){
        $timezone = $this->getTimeZoneFromState($this->state);

        $localTime = new Carbon( $this->start_time, config('app.timezone'));


        $dt = Carbon::createFromTimestamp($localTime->timestamp, $timezone);


        return $dt->format("h:i A");
    }

    public function getFullStartTime(){
        $timezone = $this->getTimeZoneFromState($this->state);

        $localTime = new Carbon( $this->start_time, config('app.timezone'));


        $dt = Carbon::createFromTimestamp($localTime->timestamp, $timezone);


        return $dt->format("m/d/Y h:i A");
    }

    public function getEndTime(){
        $timezone = $this->getTimeZoneFromState($this->state);
        $localTime = new Carbon( $this->end_time, config('app.timezone'));

        $dt = Carbon::createFromTimestamp($localTime->timestamp, $timezone);

        return $dt->format("h:i A");
    }

    public function getFullEndTime(){
        $timezone = $this->getTimeZoneFromState($this->state);
        $localTime = new Carbon( $this->end_time, config('app.timezone'));

        $dt = Carbon::createFromTimestamp($localTime->timestamp, $timezone);
        $current_time = $dt->format("m/d/Y h:i A");

        return $current_time;
    }

    public function ConvertTimeToUTC($time, $timezone){
        $localTime = Carbon::createFromFormat('m/d/Y h:i A', $time, $timezone);
        return Carbon::createFromTimestamp($localTime->timestamp, config('app.timezone'));
    }

    public function ConvertTimeToLocal($time, $timezone) {

        return Carbon::createFromTimestamp($time->timestamp, $timezone);
    }

    public function getHours() {

        if($this->credits == 1)
            return $this->credits . " Hour";
        else
            return $this->credits . " Hours";

    }
    public function getTimeZoneFromState($state){

        $TimeZones = array(
            'ME' => 'US/Eastern',
            'NH' => 'US/Eastern',
            'MA' => 'US/Eastern',
            'VT' => 'US/Eastern',
            'RI' => 'US/Eastern',
            'NY' => 'US/Eastern',
            'CT' => 'US/Eastern',
            'NJ' => 'US/Eastern',
            'DE' => 'US/Eastern',
            'MD' => 'US/Eastern',
            'PA' => 'US/Eastern',
            'WV' => 'US/Eastern',
            'VA' => 'US/Eastern',
            'NC' => 'US/Eastern',
            'SC' => 'US/Eastern',
            'GA' => 'US/Eastern',
            'FL' => 'US/Eastern',
            'OH' => 'US/Eastern',
            'MI' => 'US/Eastern',
            'IN' => 'US/Eastern',
            'KY' => 'US/Eastern',
            'WI' => 'US/Central',
            'IL' => 'US/Central',
            'TN' => 'US/Central',
            'AL' => 'US/Central',
            'MN' => 'US/Central',
            'IA' => 'US/Central',
            'MO' => 'US/Central',
            'AR' => 'US/Central',
            'MS' => 'US/Central',
            'LA' => 'US/Central',
            'ND' => 'US/Central',
            'SD' => 'US/Central',
            'NE' => 'US/Central',
            'KS' => 'US/Central',
            'OK' => 'US/Central',
            'TX' => 'US/Central',
            'MT' => 'US/Mountain',
            'WY' => 'US/Mountain',
            'CO' => 'US/Mountain',
            'NM' => 'US/Mountain',
            'ID' => 'US/Mountain',
            'UT' => 'US/Mountain',
            'AZ' => 'US/Mountain',
            'WA' => 'America/Los_Angeles',
            'OR' => 'America/Los_Angeles',
            'NV' => 'America/Los_Angeles',
            'CA' => 'America/Los_Angeles',
            'AK' => 'US/Alaska',
            'HI' => 'Pacific/Honolulu',
        );

        return $TimeZones[$state];
    }

    public function getGoogleMapURL() {
         $Key = "AIzaSyAvDAy4bnVXZOU-nD_nvNfrgw2-yTLyYXk";

         $Query = str_replace(' ', '+', $this->address) . "," . str_replace(' ', '+', $this->city) . "," . $this->state;
         $URL = "https://www.google.com/maps/embed/v1/place?key=" . $Key . "&q=" . $Query;

        return $URL;
    }
}
