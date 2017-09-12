<?php namespace App;

use App\User;
use App\Volunteer;
use Illuminate\Database\Eloquent\Model;


class Group extends \Eloquent
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'target_credits', 'type', 'org_rules','event_rules', 'email', 'state', 'city', 'zipcode', 'phone', 'address'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['user_id', 'type'];

    public function group()
    {
        return $this->belongsTo('App/Group');
    }


    public function getGroupMembers() {

         
         
         $Users = User::where('group_id', '=', $this->id)->where('role','=','volunteer')->get();      
          
        return $Users;
         
    }

    public function getGroupModerators() {

         $Users = User::where('group_id', '=', $this->id)->where('role','=','group')->get();      
          
        return $Users;
    }
}
