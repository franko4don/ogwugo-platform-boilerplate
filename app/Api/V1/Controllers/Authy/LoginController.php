<?php

namespace App\Api\V1\Controllers\Authy;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use App\Helpers\Helper;
use App\Helpers\Http;
use App\Model\V1\OrganizationUser;
use App\Model\V1\Organization;
use App\Model\V1\User;
use Hash;
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
        
        $credentials = $request->only(['email', 'password']);
        
        try {
            
            $token = Auth::guard()->attempt($credentials);
            
            if(!$token) {
                
                throw new AccessDeniedHttpException();
            }
           
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

    /**
     * Log the user in from organization
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
    public function loginFromOrganization(LoginRequest $request, JWTAuth $JWTAuth)
    {
        $host = Helper::getRequestHost();
        $organization = Organization::where('domain_name', $host)->first();

        if(!$organization){
            return $this->notfound('Organization does not exist');
        }

        try {

            $organizationUser = OrganizationUser::where('email', $request->email)->first();
            if($organizationUser){
                if(Hash::check($request->password, $organizationUser->password)){
                    $user = User::find($organizationUser->user_id);
                    
                    $token = $JWTAuth->customClaims(['claims' => $organizationUser->toArray()])->fromUser($user);
                    
                    if(!$token) {
                
                        throw new AccessDeniedHttpException();
                    }

                    // send details to other apps for authentication
                    $organization->load('apps');
                    
                    $apps = $this->authenticateApps($organization, $user, $organizationUser);

                    return response()
                        ->json([
                            'data' => [
                                'user' => $user, 
                                'apps' => $apps
                            ],
                            'status' => 'success',
                            'token' => $token,
                            'expires_in' => Auth::guard()->factory()->getTTL() * 60
                        ]);
                }
            }

            $errors = ['Incorrect email or password'];
            return $this->validationFailed('422 Unprocessable Entity', $errors);
            
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

    public function authenticateApps($organization, $user, $organizationUser){
        $apps = [];
        // goes through all the apps the organization belongs to and authenticates them
        $organization->apps->each(function($item, $key) use (&$apps, $user, $organizationUser){
            try{
                $payload = ['user' => $user, 'claims' => $organizationUser->toArray()];
                $result = Http::post($item->api_url, ['json' => $payload]);

                if(Http::getStatusCode() == 200){
                    $item->token = $result['token'];
                    $item->expires_in = $result['expires_in'];
                    array_push($apps, $item);
                }
            }catch(\Exception $e){
                
            }
            
        });
        return $apps;
    }
}
