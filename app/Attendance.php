<?php namespace App;

use App\User;
use App\Volunteer;
use Illuminate\Database\Eloquent\Model;

class Attendance extends \Eloquent {

    protected $table = "attendance";
    protected $fillable = ['event_id','user_id', 'checked_in'];

    public function user(){

        return $this->belongsTo('App\User');

    }

    public function event(){

        return $this->belongsTo('App\Event');

    }

}