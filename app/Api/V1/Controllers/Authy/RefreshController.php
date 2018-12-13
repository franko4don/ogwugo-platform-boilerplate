<?php

namespace App\Api\V1\Controllers\Authy;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Auth;

class RefreshController extends Controller
{
    /**
     * Refresh a token.
     * @group Auth
     * @response{
     *  "status": "ok",
     *  "token": "fdsvgdrufsversdubfvgydrsfhewjsyveasdgrgcwasjgvdwwsd",
     *  "expires_in": 345653
     * }
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $token = Auth::guard()->refresh();

        return response()->json([
            'status' => 'success',
            'token' => $token,
            'expires_in' => Auth::guard()->factory()->getTTL() * 60
        ]);
    }
}
