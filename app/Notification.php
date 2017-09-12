<?php namespace App;

use App\User;
use App\Volunteer;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notification extends \Eloquent {



    protected $table = "notification";

    protected $fillable = ['user_id','message'];

    public function getDates()
    {
        return ['created_at', 'updated_at'];
    }

}