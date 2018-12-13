<?php

namespace App\Api\V1\Controllers\Authy;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Auth;

class LoginController extends Controller
{
    /**
     * Log the user in
     * @group Auth
     * @bodyParam email string required The email of user.
     * @bodyParam password string required The password of user.
     * @response{
     *  "status": "ok",
     *  "token": "fdsvgdrufsversdubfvgydrsfhewjrdvsfvsetdvbfwredsfvywehrdvsyveasdgrgcwasjgvdwwsd",
     *  "expires_in": 345653
     * }
     * @param LoginRequest $request
     * @param JWTAuth $JWTAuth
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request, JWTAuth $JWTAuth)
    {
        // dd(request()->getHttpHost());
        $credentials = $request->only(['email', 'password']);
        
        try {
           
            $token = Auth::guard()->attempt($credentials);
            
            if(!$token) {
                
                throw new AccessDeniedHttpException();
            }
            // $user = Auth::guard()->setToken($token)->getUser();
            
        } catch (JWTException $e) {
          
            throw new HttpException(500);
        }

        return response()
            ->json([
                'status' => 'success',
                'token' => $token,
                'expires_in' => Auth::guard()->factory()->getTTL() * 60
            ]);
    }
}
