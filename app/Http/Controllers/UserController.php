<?php namespace App\Http\Controllers;

use App\User;
use App\Volunteer;
use App\Group;
use App\Organization;


class UserController extends Controller {

	/**
     * User Model
     * @var User
     */
	protected $user;

	/**
     * Volunteer Model
     * @var Volunteer
     */
	protected $volunteer;

	/**
     * Inject the models.
     * @param User $user
     */
	public function __construct(User $user) {

		$this->user = $user;
		$this->volunteer = $this->user->volunteer;
	}
	

}

?>