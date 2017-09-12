<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Volunteer extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'volunteers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'birthdate', 'phone', 'target_credits', 'current_credits', 'type', 'grade'];


    //protected $hidden = ['user_id', 'type'];
    public function getDates()
    {
        return ['created_at', 'updated_at', 'birthdate'];
    }

    public function volunteer(){

        return $this->belongsTo('App\Volunteer');

    }

    public function user() {

        return $this->belongsTo('App\User');
    }

    public function getGradeOrdinal()
    {
        $num = $this->grade;

        if (!in_array(($num % 100),array(11,12,13))){
            switch ($num % 10) {
                // Handle 1st, 2nd, 3rd
                case 1:  return $num.'st';
                case 2:  return $num.'nd';
                case 3:  return $num.'rd';
            }
        }

        return $num.'th';
    }

    public function getAge() {

        // TODO: function to calculate age from birthdate field.

        return $this->birthdate->age;
    }

    public function getHoursEearned() {

        return $this->current_credits;
    }

    public function getTargetCredits() {

        return $this->target_credits;
    }

    public function AgeCheck($minAge){

        if($this->birthdate->age >= $minAge) return true;
        return false;
    }
}
