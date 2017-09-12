<?php namespace App\Http\Controllers;

use Auth;
use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Input;
use Validator;
use App\Organization;
use App\Attendance;
use App\Volunteer;
use App\Invite;
use App\ScreeningData;
use App\Screening;
use Redirect;
use Illuminate\Support\Facades\DB;
use Form;
use Response;
use Toast;

class ScreeningController extends Controller {

    protected $redirectPath = "/events/create";

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function getFormData($id) {
        if(Auth::check()) {
            $user = Auth::user();

            if ($user->role == "organization") {


               $data = ScreeningData::Where('id', '=', $id)->get();

                if(!$data->isEmpty()) {

                    $data = $data[0];


                    return Response::json(array(
                        'success' => true,
                        'data' => $data->data
                    ));

                }
            }
        }


    }

    public function postVerifyUser($id, Request $request) {
        if(Auth::check()) {
            $user = Auth::user();


            if ($user->role == "organization") {

                $screen = ScreeningData::Where('id', '=', $id)->get();
                if(!$screen->isEmpty()) {
                    $screen = $screen[0];

                    $screen->status = $request->all()['screen'];

                    $screen->save();


                }

            }
        }
    }
    public function postScreenData($id, Request $request) {
        if(Auth::check()) {
            $user = Auth::user();


            if ($user->role == "volunteer") {

                $screen = Screening::Where('id', '=', $id)->get();
                if(!$screen->isEmpty()) {
                    $screen = $screen[0];
                    $data = new ScreeningData( array(
                        "user_id" => $user->id,
                        "screening_id" => $screen->id,
                        "organization_id" => $id,
                        "data" => json_encode($request->all()),
                        "stats" => "pending"

                    ));

                    $data->save();

                    Toast::success('Your application has been sent!', 'Success!');

                    return redirect(url("/dashboard"));
                }

            }
        }

        return redirect(url("/"));
    }
    public function getScreenFormForOrg($id) {

        if(Auth::check()){
            $user = Auth::user();

            if($user->role == "volunteer"){

                $form = Screening::Where('organization_id', '=', $id)->get();

                if(!$form->isEmpty()) {

                    $form = $form[0];

                    $html = str_replace(array(
                        '{post_url}',
                        '{token}'
                    ),
                        array(
                            url('/screen/' . $form->id),
                            Form::token()

                        ), $form->form);

                    return view('screening.view')->with(compact('form', $form))->with(compact('html', $html));
                }
            }
       }

        return redirect(url("/"));
    }

    private function ProcessForm($form) {

    }
    public function getScreenForm($id) {

        if(Auth::check()){

            $user = Auth::user();

            if($user->role == "organization"){

                $data = ScreeningData::Where('id', '=', $id)->get();

                if(!$data->isEmpty())
                {

                    $data = $data[0];

                    if($data->organization_id == $user->organization_id) {
                        $form = $data;

                        $html = str_replace(array(
                            '{post_url}'
                        ),
                            array(
                                url('/screening/' . $id)

                            ), $form->screening->form);

                        return view('screening.viewdata')->with(compact('form', $form))->with(compact('html', $html));

                    }

                }


            }
        }

        return redirect(url("/"));

    }
}