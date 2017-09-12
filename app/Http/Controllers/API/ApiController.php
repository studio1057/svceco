<?php  namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;


//use Illuminate\Http\Response;
use Illuminate\Contracts\Routing\ResponseFactory;

class ApiController extends Controller {

    protected $statusCode = 200;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function respondNotFound($message = 'Not Found!')
    {
            return $this->setStatusCode(404)->respondWithError($message);
    }

    public function respond( $data, $headers = [])
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'status_code' => $this->getStatusCode()
        ], $this->getStatusCode(), $headers);

    }

    public function respondWithInternalError($message)
    {
        return $this->setStatusCode(400)->respondWithError($message);
    }
    public function respondWithError($message) {

        return response()->json([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ],$this->getStatusCode());
    }
}