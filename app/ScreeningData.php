<?php namespace App;

use App\User;
use App\Volunteer;
use App\Screening;
use Illuminate\Database\Eloquent\Model;

class ScreeningData extends \Eloquent {



    protected $table = "screeningdata";

    protected $fillable = ['screening_id', 'user_id', 'organization_id', 'data', 'status'];


    public function screening(){

        return $this->belongsTo('App\Screening');

    }

    public function user() {
        return $this->belongsTo('App\User');
    }

}