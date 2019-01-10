<?php

namespace App\Api\V1\Controllers;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Auth;

class UserController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('jwt.auth', []);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        define('NEXMO_API_KEY', '02d16dab');
        define('NEXMO_API_SECRET', 'c9Og0J2yQdNFOM0O');
        define('TO_NUMBER', '2347037219055');
        $basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
        $client = new \Nexmo\Client($basic);

        $message = $client->message()->send([
            'to' => TO_NUMBER,
            'from' => 'Ego gi',
            'text' => 'A text message sent using the Nexmo SMS API'
        ]);
        // return response()->json(Auth::guard()->user());
    }
}
