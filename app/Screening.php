<?php namespace App;

use App\User;
use App\Volunteer;
use Illuminate\Database\Eloquent\Model;

class Screening extends \Eloquent {



    protected $table = "screening";

    protected $fillable = ['organization_id', 'pdf', 'form', 'status'];



}