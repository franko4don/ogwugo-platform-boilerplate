<?php

namespace App\Api\V1\Controllers\Authy;

use Config;
use App\Model\V1\User;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\SignUpRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Auth;

class SignUpController extends Controller
{
    /**
     * Creates a user in the database
     * @group Auth
     * @bodyParam firstname string required The firstname of user.
     * @bodyParam lastname string required The lastname of user.
     * @bodyParam email string The email of user.
     * @bodyParam password string The password of user
     * @response{
     *  "status": "ok",
     *  "token": "fdsvgdrufsversdubfvgydrsfhewjrdvsfvsetdvbfwredsfvywehrdvsyveasdgrgcwasjgvdwwsd",
     *  "expires_in": 345653
     * }
     * 
    */
    public function signUp(SignUpRequest $request, JWTAuth $JWTAuth)
    {
        $user = new User($request->all());
        if(!$user->save()) {
            throw new HttpException(500);
        }

        if(!Config::get('boilerplate.sign_up.release_token')) {
            return response()->json([
                'status' => 'success'
            ], 201);
        }

        $token = $JWTAuth->fromUser($user);
        return response()->json([
            'status' => 'success',
            'token' => $token,
            'expires_in' => Auth::guard()->factory()->getTTL() * 60
        ], 201);
    }
}
