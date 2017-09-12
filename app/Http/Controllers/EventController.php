<?php namespace App\Http\Controllers;

use App\Attendance;
use App\Blacklist;
use App\Event;
use App\Jobs\CreateNotification;
use App\Organization;
use Auth;
use Carbon\Carbon;
use GeoIP;
use HTML;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Redirect;
use Toast;
use Validator;

class EventController extends Controller {

    protected $redirectPath = "/events/create";

    public function __construct()
    {
       // $this->middleware('auth');
    }

    public function getCreateEvent(){

        if(Auth::check())
        {

            $minutes = Carbon::now()->addMinutes(1);



            $EventTypes = Cache::remember('event_category', $minutes, function()
            {
                return DB::table('event_category')->select('id', 'type')->get();
                //return DB::table('groups')->select('id', 'name')->get()->skip(1);
            });

            return view("events.create")->with(compact("EventTypes",$EventTypes));
        }
    }

    public function getEvents(Request $request) {

        $Events = $this->getRuleFilter();




        if($request->has('category')) {

            $cat = HTML::decode(strtolower($request->input('category')));


            $minutes = Carbon::now()->addMinutes(1);

            $OrgTypes = Cache::remember('organization_category', $minutes, function()
            {
                return DB::table('organization_category')->select('id', 'type')->get();
                //return DB::table('groups')->select('id', 'name')->get()->skip(1);
            });

            $catId = 0;

            foreach($OrgTypes as $Type) {

                if(strtolower($Type->type) == $cat) {


                    $catId = $Type->id;
                    break;
                }
            }

            $Events = $Events->where('org_category','=', $catId);


        }
        $Events = $Events->paginate(6);



        $Featured = null;

        $Featured = Event::Where('featured', '=', true);

        //$Featured = $this->getRuleFilter($Featured);
        $Featured = $Featured->get();

        // limit this to one for now.
        if (!$Featured->IsEmpty()) {

            $Featured = $Featured[0];
        }

        $location = GeoIP::getLocation();

        $minutes = Carbon::now()->addMinutes(1);




        $EventTypes = Cache::remember('event_category', $minutes, function()
        {
            return DB::table('event_category')->select('id', 'type')->get();
            //return DB::table('groups')->select('id', 'name')->get()->skip(1);
        });

        $OrgTypes = Cache::remember('organization_category', $minutes, function()
        {
            return DB::table('organization_category')->select('id', 'type')->get();
            //return DB::table('groups')->select('id', 'name')->get()->skip(1);
        });





        return view("events.grid")
            ->with(compact('Events', $Events))
            ->with(compact("Featured", $Featured))
            ->with(compact("EventTypes", $EventTypes))
            ->with(compact("OrgTypes",$OrgTypes))
            ->with(compact('location', $location));
    }

    public function postFilterEvents(Request $request) {

        $data = $request->all();

        $Events = $this->getRuleFilter();

        $credits = intval($data["credits"]);
        $event = intval($data["event"]);
        $org = intval($data["org"]);



        if( $credits > 0 )
        {
            $Events->where("credits", "=", $credits);

        }

        if( $event > 0 ) {

            $Events->where("category", "=", $event);

        }

        if( $org > 0 ) {


                $Events->where("org_category", "=", $org);

        }

        $Events = $Events->paginate(6);



        //$Events->setPath('/events');

        $location = GeoIP::getLocation();

        $minutes = Carbon::now()->addMinutes(1);

        $Featured = Event::Where('featured', '=', true);

        //$Featured = $this->getRuleFilter($Featured);
        $Featured = $Featured->get();

        // limit this to one for now.
        if (!$Featured->IsEmpty()) {

            $Featured = $Featured[0];
        }

        $EventTypes = Cache::remember('event_category', $minutes, function()
        {
            return DB::table('event_category')->select('id', 'type')->get();
            //return DB::table('groups')->select('id', 'name')->get()->skip(1);
        });

        $OrgTypes = Cache::remember('organization_category', $minutes, function()
        {
            return DB::table('organization_category')->select('id', 'type')->get();
            //return DB::table('groups')->select('id', 'name')->get()->skip(1);
        });

        return view("events.grid")
            ->with(compact('Events', $Events))
            ->with(compact("Featured", $Featured))
            ->with(compact("EventTypes", $EventTypes))
            ->with(compact("OrgTypes",$OrgTypes))
            ->with(compact('location', $location));
    }

    public function getRuleFilter() {

        $Events = Event::Where('status', '!=', 'ended')->Where('status','!=', 'completed')->Where('status','!=', 'canceled');



        if(Auth::check()) {

            $user = Auth::user();

            if($user->IsMember()) {

                /*
                if($user->group->org_rules !== '') {


                    $org_rules = json_decode($user->group->org_rules);

                    foreach ($org_rules as $rule) {
                        $Events->Where('org_category', '!=', $rule);
                    }


                }

                if($user->group->event_rules !== '') {
                    $event_rules = json_decode($user->group->event_rules);

                    foreach ($event_rules as $rule)
                        $Events->Where('category', '!=', $rule);
                }*/

                $filters = Blacklist::Where('group_id', '=', $user->group_id)->get();

                foreach($filters as $filter) {
                    $Events->Where('organization_id', '!=', $filter->organization_id);
                }




                return $Events;

            }

        }



        return $Events;

    }

    public function toggleFeatured( $OrganizationSlug, $EventSlug )
    {

        $org = Organization::findBySlug($OrganizationSlug);

        if (!is_null($org)) {
            $event = Event::findBySlug($EventSlug);


            if (!is_null($event)) {


                if (Auth::check()) {
                    $user = Auth::user();

                    if($user->role == "admin") {

                        if($event->featured == false) {
                            $event->featured = true;
                            $event->save();
                        }
                        else {
                            $event->featured = false;
                            $event->save();
                        }

                        Toast::success('Event featured has been toggled.', 'Success!');

                        return redirect(url(Request::url()));
                    }
                }
            }

        }

        return redirect(url("/"));
    }

    public function getRoster($OrganizationSlug, $EventSlug) {



        $org = Organization::findBySlug($OrganizationSlug);

        if(!is_null($org))
        {
            $event = Event::findBySlug($EventSlug);



            if(!is_null($event)){



                if(Auth::check()) {
                    $user = Auth::user();


                    if($user->role == "organization" && $user->organization->id == $org->id)
                    {

                        $Users = Attendance::Where('event_id', '=', $event->id)->where('checked_in', '=', false)->paginate(15);


                        return view("events.roster")->with(compact("Users", $Users));
                    }

                }
            }
        }

        return redirect($this->redirectPath);

    }

    public function getComplete($OrganizationSlug, $EventSlug) {



        $org = Organization::findBySlug($OrganizationSlug);

        if(!is_null($org))
        {
            $event = Event::findBySlug($EventSlug);



            if(!is_null($event)){



                if(Auth::check()) {
                    $user = Auth::user();


                    if($user->role == "organization" && $user->organization->id == $org->id)
                    {
                         $event->status = 'processing';
                         $event->save();

                        Toast::success('Event has been marked as completed!', 'Success!');

                        return redirect(url("/dashboard"));
                    }

                }
            }
        }

        return redirect($this->redirectPath);

    }

    public function getEditEvent($OrganizationSlug, $EventSlug) {

        $org = Organization::findBySlug($OrganizationSlug);

        if(!is_null($org))
        {
            $event = Event::findBySlug($EventSlug);
            $upcoming  =  Event::Where('organization_id', '=', $org->id)->orderBy('start_time')->take(4)->get();

            if(!is_null($event)){

                if(Auth::check()) {
                    $user = Auth::user();
                    if($user->role == "organization") {

                        if($user->organization->id == $event->organization_id) {

                            $minutes = Carbon::now()->addMinutes(1);



                            $EventTypes = Cache::remember('event_category', $minutes, function()
                            {
                                return DB::table('event_category')->select('id', 'type')->get();
                                //return DB::table('groups')->select('id', 'name')->get()->skip(1);
                            });



                            return view('events.edit')
                                ->with(compact('user', $user))
                                ->with(compact('event', $event))
                                ->with(compact("EventTypes",$EventTypes));

                        }
                    }

                }


            }
        }
        return redirect($this->redirectPath);
    }

    public function getEvent($OrganizationSlug, $EventSlug) {

        $org = Organization::findBySlug($OrganizationSlug);

        if(!is_null($org))
        {
            $event = Event::findBySlug($EventSlug);
            $upcoming  =  Event::Where('organization_id', '=', $org->id)->where('status','=','pending')->orderBy('start_time')->take(4)->get();

            if(!is_null($event)){
                $currentVolunteers = Attendance::whereEventId($event->id)->count();

                if(Auth::check()) {
                    $user = Auth::user();
                    return view('events.view')
                        ->with(compact('user', $user))
                        ->with(compact('event', $event))
                        ->with(compact('upcoming',$upcoming))
                        ->with(compact('currentVolunteers', $currentVolunteers));
                }

                return view('events.view', compact('event', $event))
                    ->with(compact('upcoming',$upcoming))
                    ->with(compact('currentVolunteers', $currentVolunteers));
            }
        }
        return redirect($this->redirectPath);
    }

    public function test() {

        $Events = Event::Where('status', '=', 'processing')->get();

        if(!$Events->isEmpty() ) {

            foreach ($Events as $Event) {
                $Event->status = "completed";
                $Event->save();

                $Users = Attendance::where('event_id', '=', $Event->id)->where('checked_in', '=', true)->get();


                foreach ($Users as $User) {

                    $User->user->volunteer->current_credits = $User->user->volunteer->current_credits + $Event->credits;

                    $User->user->volunteer->save();
                    $User->user->save();

                }
            }
        }
    }
    public function getCancel($OrganizationSlug, $EventSlug) {

        $org = Organization::findBySlug($OrganizationSlug);

        if(!is_null($org))
        {
            $event = Event::findBySlug($EventSlug);
            $upcoming  =  Event::Where('organization_id', '=', $org->id)->orderBy('start_time')->take(4)->get();

            if(!is_null($event)){

                if(Auth::check()) {
                    $user = Auth::user();

                    if($user->role == "organization" && $event->organization_id == $user->organization->id) {

                        $event->status = 'canceling';
                        $event->save();

                        return redirect(url(('/dashboard')));
                    }
                    return redirect(url(('/dashboard')));

                }

                return redirect(url(('/dashboard')));
            }
        }
        return redirect( url('/'));
    }


    public function postCheckIn($OrganizationSlug, $EventSlug, Request $request) {

        if(Auth::check()) {
            $user = Auth::user();
            $data = $request->all();
            if ($user->role == "organization") {
                $checked = Attendance::where('user_id', '=', $data["user_id"])->where('event_id', '=', $data["event_id"])->take(1)->get();
                if(!$checked->isEmpty()) {
                    $checked = $checked[0];
                    $checked->checked_in = true;
                    $checked->save();
                    Toast::success('User has been checked in', 'Success!');

                    return redirect(url($request->url()));
                }
            }
        }

        return redirect(url("/"));
    }

    public function postJoinEvent($OrganizationSlug, $EventSlug) {

        $org = Organization::findBySlug($OrganizationSlug);

        if(!is_null($org))
        {
            $event = Event::findBySlug($EventSlug);
            $upcoming  =  Event::Where('organization_id', '=', $org->id)->orderBy('start_time')->take(4)->get();

            if(!is_null($event)){

                if(Auth::check())
                {
                    $user =  Auth::user();

                    if($user->role == "volunteer")
                    {
                        // time to process the join.
                        $checked = Attendance::where('user_id', '=', $user->id)->where('event_id', '=', $event->id)->get();


                        if($checked->isEmpty()){
                            $join = new Attendance( array('event_id' => $event->id, 'user_id' => $user->id, "checked_in" => false));
                            $join->save();



                            $this->dispatch(new CreateNotification($user->id, "You Joined Event for " . $event->name));
                        }



                    }

                    return view('events.view')->with(compact('user', $user))->with(compact('event', $event))->with(compact('upcoming',$upcoming));
                }
                return view('events.view', compact('event', $event))->with(compact('upcoming',$upcoming));
            }
        }



        return Redirect::to('/login ');
    }

    public function postCancelAttendance($OrganizationSlug, $EventSlug) {
        $event      = Event::whereSlug($EventSlug)->firstOrFail();
        $user       = Auth::user();
        $attendance = Attendance::whereEventId($event->id)->whereUserId($user->id)->first();

        if (null !== $attendance) {
            $attendance->delete();

            Toast::success(sprintf(
                'Your attendance to "%s" has been canceled',
                $event->name
            ));
        }

        return Redirect::to('/dashboard');
    }


    public function postEditEvent($OrganizationSlug, $EventSlug, Request $request) {

        $org = Organization::findBySlug($OrganizationSlug);

        if(!is_null($org)) {
            $event = Event::findBySlug($EventSlug);
            if (!is_null($event)) {

                if (Auth::check()) {
                    $user = Auth::user();
                    if ($user->role == "organization") {

                        if ($user->organization->id == $event->organization_id) {

                            $currentAttendances = Attendance::whereEventId($event->id)->count();
                            $validator = $this->EditValidator($request->all(), $currentAttendances);
                            if ($validator->fails()) {
                                $this->throwValidationException(
                                    $request, $validator
                                );
                            }

                            return $this->Edit($event, $request);
                        }
                    }
                }
            }
        }

        return redirect(url("/"));
    }

    public function EditValidator(array $data, $currentAttendances) {

        return Validator::make($data, [
            'image' => 'image|mimes:jpeg,png',
            'title' => 'required|max:255',
            'desc' => 'required|max:1000',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:20',
            'start' => 'required|date_format:m/d/Y h:i A',
            'end' => 'required|date_format:m/d/Y h:i A',
            'event_type' => 'required|exists:event_category,id',
            'state' => 'required|exists:states,abbreviation',
            'city' => 'required|string|max:50',
            'zipcode' => 'required|string|max:25',
            'address' => 'required|string|max:255',
            'attendances_limit' => 'required|integer|min:' . (string) $currentAttendances,
            'credits' => 'required|integer',
            'age' => 'required|integer|min:0|max:1',

        ]);

    }

    public function postCreateEvent(Request $request) {

        $validator = $this->validator($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }

       return $this->create($request);

        //return redirect($this->redirectPath);
    }

    public function Edit(Event $Event, Request $request)
    {
        $data = $request->all();
        // get the timezone based on the state
        $tz = $this->getTimeZoneFromState($data['state']);

        // convert this to server time.
        $start = $this->ConvertTimeToUTC($data['start'], $tz);
        $end = $this->ConvertTimeToUTC($data['end'], $tz);

        $user = Auth::user();

        $Event->name = $data['title'];
        $Event->start_time = $start;
        $Event->end_time = $end;
        $Event->attendances_limit = $data['attendances_limit'];
        $Event->credits = $data["credits"];
        $Event->description = $data['desc'];
        $Event->age_requirement = $data['age'];
        $Event->city = $data['city'];
        $Event->state = $data['state'];
        $Event->zipcode = $data['zipcode'];
        $Event->address = $data['address'];
        $Event->org_category = $user->organization->category;
        $Event->category = $data["event_type"];
        $Event->phone = $data['phone'];
        $Event->email = $data['email'];

        $Event->resluggify();
        $Event->save();

        if(array_key_exists ('image', $data)) {
            $imageName = $Event->id . '.jpg';
            $imagePath = base_path() . '/public/images/events/' . $imageName;

            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }

            $request->file('image')->move(
                base_path() . '/public/images/events/', $imageName
            );

        }
        $Users = Attendance::where('event_id', '=', $Event->id)->get();

        foreach($Users as $User) {


            $this->dispatch(new CreateNotification($User->user_id,"Event " . $Event->name . " has been updated."));
        }

        return redirect(url('/' .$Event->organization->slug . '/events/'. $Event->slug));
    }

    public function validator(array $data) {
        return Validator::make($data, [
            'image' => 'required|image|mimes:jpeg,png',
            'title' => 'required|max:255',
            'desc' => 'required|max:1000',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:20',
            'start' => 'required|date_format:m/d/Y H:i A',
            'end' => 'required|date_format:m/d/Y H:i A',
            'event_type' => 'required|exists:event_category,id',
            'state' => 'required|exists:states,abbreviation',
            'city' => 'required|string|max:50',
            'zipcode' => 'required|string|max:25',
            'address' => 'required|string|max:255',
            'attendances_limit' => 'required|integer',
            'credits' => 'required|integer',
            'age' => 'required|integer|min:0|max:1',
            'screening' => 'required|integer|min:0|max:1'

        ]);

    }

    public function create(Request $request)
    {
        $data = $request->all();
        // get the timezone based on the state
        $tz = $this->getTimeZoneFromState($data['state']);

        // convert this to server time.
        $start = $this->ConvertTimeToUTC($data['start'], $tz);
        $end = $this->ConvertTimeToUTC($data['end'], $tz);

        $user = Auth::user();
        $event = new Event([
                    'organization_id' => $user->organization_id,
                    'name' => $data['title'],
                    'start_time' => $start,
                    'end_time' => $end,
                    'credits' => $data["credits"],
                    'description' => $data['desc'],
                    'screening_required' => $data['screening'],
                    'age_requirement' => $data['age'],
                    'city' => $data['city'],
                    'state' => $data['state'],
                    'zipcode' => $data['zipcode'],
                    'address' => $data['address'],
                    'org_category' => $user->organization->category,
                    'category' => $data["event_type"],
                    'phone' => $data['phone'],
                    'email' => $data['email'],
                    'max_users' => 0,
                    'status' => 'pending'

            ]
        );

        $event->save();

        $imageName = $event->id . '.jpg';


        $imagePath = base_path() . '/public/images/events/' . $imageName;

        if (Storage::exists( $imagePath ))
        {
            Storage::delete($imagePath);
        }

        $request->file('image')->move(
            base_path() . '/public/images/events/', $imageName
        );


        return redirect(url('/' .$event->organization->slug . '/events/'. $event->slug));
    }

    public function ConvertTimeToUTC($time, $timezone){
        $localTime = Carbon::createFromFormat('m/d/Y h:i A', $time, $timezone);
        return Carbon::createFromTimestamp($localTime->timestamp, config('app.timezone'));
    }

    public function ConvertTimeToLocal($time, $timezone) {

        return Carbon::createFromTimestamp($time->timestamp, $timezone);
    }
    public function getTimeZoneFromState($state){

        $TimeZones = array(
            'ME' => 'US/Eastern',
            'NH' => 'US/Eastern',
            'MA' => 'US/Eastern',
            'VT' => 'US/Eastern',
            'RI' => 'US/Eastern',
            'NY' => 'US/Eastern',
            'CT' => 'US/Eastern',
            'NJ' => 'US/Eastern',
            'DE' => 'US/Eastern',
            'MD' => 'US/Eastern',
            'PA' => 'US/Eastern',
            'WV' => 'US/Eastern',
            'VA' => 'US/Eastern',
            'NC' => 'US/Eastern',
            'SC' => 'US/Eastern',
            'GA' => 'US/Eastern',
            'FL' => 'US/Eastern',
            'OH' => 'US/Eastern',
            'MI' => 'US/Eastern',
            'IN' => 'US/Eastern',
            'KY' => 'US/Eastern',
            'WI' => 'US/Central',
            'IL' => 'US/Central',
            'TN' => 'US/Central',
            'AL' => 'US/Central',
            'MN' => 'US/Central',
            'IA' => 'US/Central',
            'MO' => 'US/Central',
            'AR' => 'US/Central',
            'MS' => 'US/Central',
            'LA' => 'US/Central',
            'ND' => 'US/Central',
            'SD' => 'US/Central',
            'NE' => 'US/Central',
            'KS' => 'US/Central',
            'OK' => 'US/Central',
            'TX' => 'US/Central',
            'MT' => 'US/Mountain',
            'WY' => 'US/Mountain',
            'CO' => 'US/Mountain',
            'NM' => 'US/Mountain',
            'ID' => 'US/Mountain',
            'UT' => 'US/Mountain',
            'AZ' => 'US/Mountain',
            'WA' => 'America/Los_Angeles',
            'OR' => 'America/Los_Angeles',
            'NV' => 'America/Los_Angeles',
            'CA' => 'America/Los_Angeles',
            'AK' => 'US/Alaska',
            'HI' => 'Pacific/Honolulu',
         );

        return $TimeZones[$state];
    }


}
