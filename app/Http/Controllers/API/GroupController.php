<?php namespace App\Http\Controllers\API;

use App\Group;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
/**
 * Class GroupController
 * @package App\Http\Controllers
 */
class GroupController extends ApiController {


    /**
     * @return mixed
     */
    public function index() {
         return $this->respondNotFound("Not Found.");
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