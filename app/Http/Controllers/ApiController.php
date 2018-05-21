<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Carbon\Carbon;
class ApiController extends Controller
{
    
    //HTTP status codes
    static $HTTP_NOT_FOUND = 404;
    static $HTTP_OK = 200;
    static $HTTP_UNPROCESSABLE_ENTITY = 422;
    static $HTTP_UNAUTHORIZED = 401;
    static $HTTP_BAD_REQUEST = 400;
    static $HTTP_FORBIDDEN = 403;
    static $HTTP_CONFLICT= 409;


    public function currentTime(){
        $carbon = Carbon::now();
        $info = [
            "status" => 'success',
            "response" => self::$HTTP_OK,
            'message' => 'Current Time',
            "data" => [
                'currentTime' => $carbon->format('l, jS F Y'),
                'currentYear' => $carbon->format('Y')
            ]
        ];
        return Response::json($info,self::$HTTP_OK);
    }

    /**
     * Returns a json when data is not found
     *
     * @param [string] $message
     * @param [array] $errors
     * @return json
     */
    public function notFound($message, $errors = null){
        $error_message = is_null($errors) ? 'not specified' : $errors;
        $info = [
            "status" => 'failed',
            "response" => self::$HTTP_NOT_FOUND,
            'message' => $message,
            'errors' => $error_message,
        ];
        return Response::json($info,self::$HTTP_NOT_FOUND);
    }


    /**
     * Executes and returns well formatted json of errors 
     * that occured during validation
     *
     * @param [string] $message
     * @param [collection] $errors
     * @return json
     */
    public function validationFailed($message, $errors){
        
        $info = [
            "status" => 'failed',
            "response" => self::$HTTP_UNPROCESSABLE_ENTITY,
            'message' => $message,
            'errors' => $errors,
        ];
        return Response::json($info,self::$HTTP_UNPROCESSABLE_ENTITY);
    }


    /**
     * Returns json stating why a request is unauthorized
     * @param [string] $message
     * @return json
     */
    public function unauthorized($message){
        $info = [
            "status" => 'failed',
            "response" => self::$HTTP_UNAUTHORIZED,
            'message' => $message,
            'errors' => [$message]
        ];
        return Response::json($info,self::$HTTP_UNAUTHORIZED);
    }

    /**
     * Returns json stating why data creation failed
     * @param [string] $message
     * @return json
     */
    public function dataCreationFailed($message){
        $info = [
            "status" => 'failed',
            "response" => self::$HTTP_BAD_REQUEST,
            'message' => $message,
            'errors' => [$message]
        ];
        return Response::json($info,self::$HTTP_BAD_REQUEST);
    }

    /**
     * Returns json stating why data creation failed
     * @param [string] $message
     * @return json
     */
    public function actionSuccess($message){
        $info = [
            "status" => 'success',
            "response" => self::$HTTP_OK,
            'message' => $message,
        ];
        return Response::json($info,self::$HTTP_OK);
    }

    /**
     * Returns json stating why data creation failed
     * @param [string] $message
     * @return json
     */
    public function actionFailure($message){
        $info = [
            "status" => 'failed',
            "response" => self::$HTTP_CONFLICT,
            'message' => $message,
        ];
        return Response::json($info,self::$HTTP_CONFLICT);
    }


    /**
     * Returns json 
     * @param [string] $message
     * @return json
     */
    public function forbidden($message){
        $info = [
            "status" => 'failed',
            "response" => self::$HTTP_FORBIDDEN,
            'message' => $message,
        ];
        return Response::json($info,self::$HTTP_FORBIDDEN);
    }

}
