<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Api\V1\Requests\RoleRequest;
use App\Api\V1\Requests\AssignRoleRequest;
use App\Model\V1\App;
use Bouncer;
use Auth;

class Rolecontroller extends Controller
{
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth', []);
        
    }

    /**
     * Creates role
     * @bodyParam name string required name of the role
     * @bodyParam title string required title of the role
     * @responseFile responses/general/200.json {"message" : "Role created"}
     * @group Role
     * @param mixed $request
     * @return json
     * 
     */
    public function create(RoleRequest $request){
        $credentials = $request->only(['name', 'title']);
        $role = Bouncer::role()->firstOrCreate($credentials);
        return $this->success($role);
    }


    /**
     * Assign role to user
     * @bodyParam user_id string required uuid of the user to be assigned a role
     * @bodyParam permission string required name of the permission to be assigned
     * @bodyParam model string required model name the user will be granted permission to
     * @responseFile responses/general/200.json {"message" : "Edit Permission has been granted to user"}
     * @group Role
     * @param mixed $request
     * @return json
     * 
     */
    public function assignRole(AssignRoleRequest $request){

        $model = "App\Model\V1\App";
      //  $user = ""; // change this user to uuid that will be sent with the request
        $permission = "edit";
        
        $user = Auth::guard()->setToken(request()->bearerToken())->getUser();
        Bouncer::allow($user)->to($permission, $model);
        return $this->actionSuccess("$permission Permission has been granted to user");
    }
}
