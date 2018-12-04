<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function currentTime(){
        $carbon = Carbon::now();
        $info = [
            "status" => 'success',
            "status_code" => self::$HTTP_OK,
            'message' => 'Current Time',
            "data" => [
                'currentTime' => $carbon->format('l, jS F Y'),
                'currentYear' => $carbon->format('Y'),
                'todayDate'  => $carbon
            ]
        ];
        return Response::json($info,self::$HTTP_OK);
    }
 
 
    /**
     * Returns a json when data is not found
     *
     * @param string $message
     * @param array $errors
     * @return json
     */
    private static function notFound($message, $errors = null){
        $error_message = is_null($errors) ? 'not specified' : $errors;
        $info = [
            "status" => 'failed',
            "status_code" => self::$HTTP_NOT_FOUND,
            'message' => $message,
            'errors' => $error_message,
        ];
        return Response::json($info,self::$HTTP_NOT_FOUND);
    }
 
 
    /**
     * Executes and returns well formatted json of errors 
     * that occured during validation
     *
     * @param string $message
     * @param collection $errors
     * @return json
     */
    private static function validationFailed($message, $errors){
        
        $info = [
            "status" => 'failed',
            "status_code" => self::$HTTP_UNPROCESSABLE_ENTITY,
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
    private static function unauthorized($message){
        $info = [
            "status" => 'failed',
            "status_code" => self::$HTTP_UNAUTHORIZED,
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
    private static function dataCreationFailed($message){
        $info = [
            "status" => 'failed',
            "status_code" => self::$HTTP_BAD_REQUEST,
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
    private static function actionSuccess($message){
        $info = [
            "status" => 'success',
            "status_code" => self::$HTTP_OK,
            'message' => $message,
        ];
        return Response::json($info,self::$HTTP_OK);
    }
 
 
    /**
     * Returns json stating why data creation failed
     * @param [string] $message
     * @return json
     */
    public static function actionFailure($message){
        $info = [
            "status" => 'failed',
            "status_code" => self::$HTTP_CONFLICT,
            'message' => $message,
        ];
        return Response::json($info,self::$HTTP_CONFLICT);
    }
 
 
    /**
     * Returns json 
     * @param [string] $message
     * @return json
     */
    public static function forbidden($message){
        $info = [
            "status" => 'failed',
            "status_code" => self::$HTTP_FORBIDDEN,
            'message' => $message,
        ];
        return Response::json($info,self::$HTTP_FORBIDDEN);
    }
}
