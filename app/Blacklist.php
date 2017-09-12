<?php namespace App;


use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model {


    protected $table = "blacklist";

    protected $fillable = ['group_id', 'organization_id'];

    public function organization(){

        return $this->belongsTo('App\Organization');

    }

}