<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Event;
use App\User;
use App\Notification;
use Mail;
use GeoIP;

class HomeController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }
    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $minutes = Carbon::now()->addMinutes(60);


        // use a cache to reduce mysql queries
       /* $Events = Cache::remember('Events', $minutes, function()
        {
            return DB::table('event')->take(10)->get();
        });*/

        $location = GeoIP::getLocation();

        $Events = Event::Where('status','=','pending')->where('state', '=', $location["state"])->take(3)->get();

        if( $Events->isEmpty() )
            $Events = Event::Where('status','=','pending')->take(3)->get();



        if(Auth::check()) {

            $user = Auth::user();

            return view('home')->with(compact('user',$user))->with(compact('Events', $Events))->with(compact('location',$location));
        }


        return view('home')->with(compact('Events', $Events))->with(compact('location',$location));
    }

    public function getSettings() {

        return "Settings";
    }

    public function getTest() {


        $user = User::Where('id', '=', 1)->get();

        if(!$user->IsEmpty() ) {
            $user = $user[0];
            $body = "test";


            Mail::send('emails.notification', ['user' => $user, 'body' => $body] , function ($message) use ($user) {
                $message->from("noreply@svceco.com","svceco.com");
                $message->to($user->email, $user->first_name)->subject('Notification from svceco.com!');
            });
        }

        return url("/");
    }
}