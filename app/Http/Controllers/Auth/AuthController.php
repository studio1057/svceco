<?php namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Group;

class AuthController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/
	use AuthenticatesAndRegistersUsers;

    private $redirectPath = '/dashboard';
	private $loginPath = '/';


	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;
		$this->middleware('guest', ['except' => 'getLogout']);
	}



	/**
	 *	Disable default register request.
	 */
	public function getIndex()
	{
        return view('register.selection');
	}

	/**
	 *	Disable default register request.
	 */
	public function postIndex(Request $request) {
        return view('register.selection');
	}


	/**
	 *	Handler for Volunteer request.
	 */
	public function getVolunteer()
	{
		$minutes = Carbon::now()->addMinutes(1);

		// use a cache to reduce mysql queries
		$groups = Cache::remember('groups', $minutes, function()
		{
		    return Group::all(['id', 'name']);
		    //return DB::table('groups')->select('id', 'name')->get()->skip(1);
		});

		$volunteerTypes = Cache::remember('volunteer_types', $minutes, function()
		{
		    return DB::table('volunteer_types')->select('id', 'type')->get();
		    //return DB::table('groups')->select('id', 'name')->get()->skip(1);
		});



		return view('register.volunteer', ['groups' => $groups, 'volunteerTypes' => $volunteerTypes]);
	}

	public function postVolunteer(Request $request)
	{
		return $this->HandlePost("Volunteer", $request);
	}


	/**
	 *	Handler for Group request.
	 */

	public function getGroup()
	{

		$minutes = Carbon::now()->addMinutes(30);


		// use a cache to reduce mysql queries
		/*$group_types = Cache::remember('group_types', $minutes, function()
		{
		    return DB::table('group_types')->select('id', 'type')->get();
		});*/

		$group_types = DB::table('group_types')->select('id', 'type')->get();


		return view('register.group')->with(compact('group_types',$group_types));
	}

	public function postGroup(Request $request)
	{
		return $this->HandlePost("Group", $request);
	}

	/**
	 *	Handler for Organization request.
	 */
	public function getOrganization()
	{
        $minutes = Carbon::now()->addMinutes(1);



        $OrgTypes = Cache::remember('organization_category', $minutes, function()
        {
            return DB::table('organization_category')->select('id', 'type')->get();
            //return DB::table('groups')->select('id', 'name')->get()->skip(1);
        });

		return view('register.organization')->with(compact("OrgTypes",$OrgTypes));

	}

	public function postOrganization(Request $request)
	{
		return $this->HandlePost("Organization", $request);
	}


	public function HandlePost($type, Request $request)
	{
		$validator = $this->registrar->getValidator($type, $request->all());

		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator
			);

            return redirect(url("/"));
		}

		$this->auth->login($this->registrar->getCreate($type, $request->all()));

        return redirect(url('/dashboard'));
	}


}
