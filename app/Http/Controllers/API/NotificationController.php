<?php namespace App\Http\Controllers\API;

use App\Notification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Auth;
/**
 * Class GroupController
 * @package App\Http\Controllers
 */
class NotificationController extends ApiController {


    /**
     * @return mixed
     */
    public function index() {
        if(Auth::check()) {
            $user = Auth::user();

            $Notifications = Notification::where('user_id','=', $user->id)->select('id','message')->get();

            return $this->respond($Notifications);
       }
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($id) {

        if(!is_numeric($id))
            return $this->respondWithInternalError("Bad Request!");


        $Groups = DB::table('groups')->where('type', '=', $id)->select('id', 'name', 'type')->get();
        if(!$Groups)
            return $this->respondNotFound("This is a test not found message.");

        return $this->respond([
            'id' => $id,
            'data' => $Groups
        ]);
    }
}