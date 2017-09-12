<?php namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Volunteer;
use App\Group;
use App\Organization;
use App\Invite;
use Redirect;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Hash;
use Carbon\Carbon;
use Toast;
use App\Event;
use Mail;

class ContactController extends Controller {

    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function postIndex(Request $request) {

        $data = $request->all();
        $validator = Validator::make($data, [

            'cf_name' => 'required|max:255',
            'cf_message' => 'required|max:1000',
            'cf_email' => 'required|email|max:255',
            'cf_phone' => 'required|max:20',
        ]);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }


        Mail::queue('emails.contact', ['cf_name' => $data['cf_name'], 'cf_email' => $data['cf_email'],
            'cf_phone' => $data['cf_phone'], 'cf_message' => $data['cf_message']], function ($m)  {
            $m->from("noreply@svceco.com","svceco.com");
            $m->to("hello@svceco.com", "svceco.com")->subject('svceco.com - Contact Form!');
        });

        Toast::success('Message has been sent!');

        return redirect(url("/"));
    }



}

?>