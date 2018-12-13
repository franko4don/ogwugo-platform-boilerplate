<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Requests\AppRequest;
use App\Helpers\Helper;
use App\Model\V1\App;

class Appcontroller extends Controller
{
    
    public function create(AppRequest $request){
        return App::create($request->all());
    }

    public function edit(AppRequest $request, App $app){
        return $app;
    }

    public function getSingleApp(Request $request, $id){
        $app =  App::find($id);
        if(is_null($app)) return $this->notfound('App not found', 'null');
        return $this->success($app);
    }
}
