<?php namespace App;


use App\Group;
use App\Volunteer;
use App\Organization;
use App\ScreeningData;
use App\Event;
use App\Attendance;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'group_id', 'organization_id', 'role', 'status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id', 'password', 'remember_token'];



    public function volunteer()
    {
        return $this->belongsTo('App\Volunteer', 'id', 'user_id');
    }

    public function user(){

        return $this->belongsTo('App\User');

    }
    public function IsMember()
    {
        $member = !is_null($this->group_id);

        if ($member)
        {
            if($this->group_id == 1)
                return false;

            return true;
        }

        return false;
    }

    public function IsOrganization(){

        return !is_null($this->organization_id);
    }

    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id', 'id');
    }

    public function organization() {

        return $this->belongsTo('App\Organization');
    }

    public function CheckedIn($EventId){

        $checked = Attendance::where('user_id', '=', $this->id)->where('event_id', '=', $EventId)->get();


        return $checked->isEmpty();

    }

    public function getGroupOrOrgName() {

        if($this->IsMember())
            return $this->group->name;
        else if( $this->IsOrganization())
            return $this->organization->name;

    }

    public function IsVerified() {

        $data = ScreeningData::Where('user_id', '=', $this->id)->get();

        if(!$data->IsEmpty()) {

            $data = $data[0];


            if($data->status == "accepted") {
                 return true;
            }
        }

        return false;

    }

    public function Credits() {

        if($this->IsMember() && (int) $this->volunteer->target_credits === 0) {
            return $this->group->target_credits;
        }
        else{
            return $this->volunteer->target_credits;
        }
    }

    public function TotalCompleted() {

        $Events = Attendance::where('user_id','=', $this->id)->where('checked_in','=',true)->get();

        $credits = 0;

        if(!$Events->IsEmpty()) {

            foreach($Events as $Event) {

                $ent = Event::where('id', '=', $Event->event->id)->get();

                if(!$ent->isEmpty()) {
                    $ent = $ent[0];

                    if ($ent->status == "completed")
                    {
                        $credits += $ent->credits;
                    }
                }

            }

        }

        if( $this->volunteer->current_credits == 0 ) return 0;

        return ($this->volunteer->current_credits / $this->Credits()) * 100;
    }

    public function TotalEvents() {

        $Events = Attendance::where('user_id','=', $this->id)->where('checked_in','=',true)->get();

        $numEvents = 0;

        if(!$Events->IsEmpty()) {

            foreach($Events as $Event) {

                $ent = Event::where('id', '=', $Event->event->id)->get();

                if(!$ent->isEmpty()) {
                    $ent = $ent[0];

                    $numEvents++;
                }

            }

        }

        return $numEvents;
    }

    public function getCompletedAttendances() {
        $attendances = Attendance::with('event')->whereUserId($this->id)->whereCheckedIn(true);

        $attendances->whereHas('event', function($query) {
            $query->whereStatus('completed');
        });

        return $attendances->get();
    }
}
