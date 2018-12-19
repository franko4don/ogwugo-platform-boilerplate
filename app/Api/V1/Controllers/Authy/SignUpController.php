<?php

namespace App\Api\V1\Controllers\Authy;

use Config;
use App\Model\V1\User;
use App\Model\V1\OrganizationUser;
use App\Model\V1\Organization;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\SignUpRequest;
use App\Api\V1\Requests\OrganizationUserRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;
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
     * @param mixed $request
     * @param mixed $JWTAuth
     * @response{
     *  "status": "ok",
     *  "token": "fdsvgdrufsversdubfvgydrsfhewjrdvsfvsetdvbfwredsfvywehrdvsyveasdgrgcwasjgvdwwsd",
     *  "expires_in": 345653
     * }
     * 
    */
    public function signUp(Request $request, JWTAuth $JWTAuth)
    {
        $validate = $this->validator($request->all());

        if($validate->fails()){
            return $this->validationFailed("422 Unprocessable entity", $validate->errors());
        }

        $user = new User($request->all());
        if(!$user->save()) {
            throw new HttpException(500);
        }

        $token = $JWTAuth->fromUser($user);
        return response()->json([
            'data' => $user,
            'status' => 'success',
            'token' => $token,
            'status_code' => 201,
            'expires_in' => Auth::guard()->factory()->getTTL() * 60
        ], 201);
    }

    /**
     * Creates a user in the database
     * @group Auth
     * @bodyParam firstname string required The firstname of user.
     * @bodyParam lastname string required The lastname of user.
     * @bodyParam email string The email of user.
     * @bodyParam password string The password of user
     * @param mixed $request
     * @param mixed $JWTAuth
     * @response{
     *  "status": "ok",
     *  "token": "fdsvgdrufsversdubfvgydrsfhewjrdvsfvsetdvbfwredsfvywehrdvsyveasdgrgcwasjgvdwwsd",
     *  "expires_in": 345653
     * }
     * 
    */
    public function signUpFromOrganization(Request $request, JWTAuth $JWTAuth)
    {   
        
        $user = User::where('email', $request->email)->first();

        if(!$user){
            $signup = $this->signUp($request, $JWTAuth);
            $status = $signup->getData()->status_code;
            if($status == 201){
                $user = User::find($signup->getData()->data->id);
                return $this->createUserOrganizationAccount($request, $user, $JWTAuth);
            }else{
                
            }
        }else{
            return $this->createUserOrganizationAccount($request, $user, $JWTAuth);
        }
        
    }

    /**
     * Creates account for user in an organization
     * @param mixed $request
     * @param mixed $user
     * @param mixed $JWTAuth
     * @return json
     */
    public function createUserOrganizationAccount($request, $user, JWTAUTH $JWTAuth){
        $host = Helper::getRequestHost();
        $organization = Organization::where('domain_name', $host)->first();
        $validate = $this->validator($request->all());
        
        if(!$organization){
            return $this->notfound('Organization does not exist');
        }

        if($validate->fails()){
            return $this->validationFailed("422 Unprocessable entity", $validate->errors());
        }

        $orguser = OrganizationUser::where('email', $request->email)
                    ->where('organization_id',$organization->id)
                    ->first();

        if(!$orguser){

            $data = $request->all(); 
            $data['user_id'] = $user->id;
            $organizationUser = new OrganizationUser($data);
            $organizationUser = $organization->organizationUser()->save($organizationUser);
            
            $token = $JWTAuth->customClaims(['user' => $organizationUser->toArray()])->fromUser($user);
            
                return response()->json([
                    'data' => $user,
                    'status' => 'success',
                    'token' => $token,
                    'expires_in' => Auth::guard()->factory()->getTTL() * 60
                ], 201);
            
        }else{
            $errors = [
                'email' => ['Email has already been taken']
            ];
            return $this->validationFailed('422 Unprocessable entity', $errors);
        }

    }

    /**
     * Get a validator for an incoming request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'nullable|string',
            'lastname' => 'nullable|string',
            'phone' => 'nullable|numeric',
            'email' => 'email|required',
            'password' => 'string|required'
        ]);
    }

    /**
     * Get a validator for an incoming request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateSignup(array $data)
    {
        return Validator::make($data, 
            Config::get('boilerplate.sign_up.validation_rules'));
    }

}
