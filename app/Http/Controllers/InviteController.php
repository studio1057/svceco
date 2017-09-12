<?php namespace App\Http\Controllers;

use Auth;
use App\Event;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Input;
use Validator;
use App\Organization;
use App\Attendance;
use App\Volunteer;
use App\Invite;
use Redirect;
use Illuminate\Support\Facades\DB;

class InviteController extends Controller {

    protected $redirectPath = "/events/create";

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function getInvite($InviteCode) {

        $invite = Invite::Where('invite_code', '=', $InviteCode)->get();

        if(!$invite->isEmpty())
        {
            $invite = $invite[0];
            $minutes = $invite->created_at->diffInHours(Carbon::now());

            if( $minutes >= 24) {
                $invite->delete();
                return redirect(url("/"));
            }
            return view("register.invite")
                ->with(compact("invite", $invite));
        }

        return redirect(url("/"));

    }


    public function postInvite($InviteCode, Request $request) {

        $invite = Invite::Where('invite_code', '=', $InviteCode)->get();

        if(!$invite->isEmpty())
        {
            $data = $request->all();

            $validator =  Validator::make($data, [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:6',
                'phone_number' => 'required|max:20',

            ]);



            if ($validator->fails()) {

                $this->throwValidationException(
                    $request, $validator
                );

            }
            $invite = $invite[0];
            $minutes = $invite->created_at->diffInHours(Carbon::now());

            if( $minutes >= 24) {
                $invite->delete();
                return redirect(url("/"));
            }

            if( $data['email'] != $invite->email)
                return redirect(url("/"));

            $NewUser = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);

            if(!is_null($invite->organization_id)) {
                $NewUser->organization_id = $invite->organization_id;
                $NewUser->role = 'organization';
                $NewUser->status = 'approved';
            }
            else {
                $NewUser->group_id = $invite->group_id;
                $NewUser->role = 'group';
                $NewUser->status = 'approved';
            }

            $NewUser->save();

            $invite->delete();

            Auth::login($NewUser);
            return redirect(url("/dashboard"));
        }

        return redirect(url("/"));

    }
}