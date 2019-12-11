<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 * Base API Controller.
 */
class APIController extends Controller
{
    /**
     * default status code.
     *
     * @var string
     */
    protected $statusCode = 200;

    /**
     * get the status code.
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }


    /**
     * set the status code.
     *
     * @param [type] $statusCode [description]
     *
     * @return string
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this->statusCode;
    }


    /**
     * Respond.
     *
     * @param $data
     *
     * @return JsonResponse
     */
    public function respond($data)
    {
        return response()->json($data,$this->getStatusCode());
    }

    /**
     * Respond Created.
     *
     * @param $data
     *
     * @return JsonResponse
     */
    public function respondCreated($data)
    {
        $this->setStatusCode(201);
        return $this->respond($data);
    }

    /**
     * respond with error.
     *
     * @param $message
     *
     * @return JsonResponse
     */
    public function respondWithError($message)
    {
        $this->setStatusCode(400);
        return $this->respond($message);
    }

    /**
     * respond with Unauthorized.
     *
     * @param $message
     *
     * @return JsonResponse
     */
    public function respondWithUnauthorized($message)
    {
        $this->setStatusCode(401);
        return $this->respond($message);
    }


}
