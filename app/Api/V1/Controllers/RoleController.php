<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Api\V1\Requests\RoleRequest;
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

    public function create(RoleRequest $request){
        $role = Bouncer::role()->firstOrCreate($request->only(['name', 'title']));
        return $this->success($role);
    }

    public function assignRole(){
        
        $user = Auth::guard()->setToken(request()->bearerToken())->getUser();
        Bouncer::allow($user)->to('edit', App::class, ['organization_id' => '34wegrthggh5r4t']);
        $abilities = $user->getAbilities();
        return $abilities;
    }
}
