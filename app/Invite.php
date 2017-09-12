<?php namespace App;

use App\User;
use App\Volunteer;
use Illuminate\Database\Eloquent\Model;

class Invite extends \Eloquent {




    protected $table = "invite";

    protected $fillable = ['organization_id', 'group_id', 'first_name', 'last_name', 'email', "invite_code"];



    public function getDates()
    {
        return ['created_at', 'updated_at'];
    }



}