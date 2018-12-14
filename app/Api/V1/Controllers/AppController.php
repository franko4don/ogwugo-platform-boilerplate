<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Requests\AppRequest;
use App\Api\V1\Requests\AppEditRequest;
use App\Helpers\Helper;
use App\Model\V1\App;
use App\Resources\GenericResource;

class Appcontroller extends Controller
{
    
    /**
     * Creates or registers and app or microservice
     * @bodyParam name string required name of the app
     * @bodyParam api_url url required api endpoint of the app
     * @bodyParam app_domain string optional domain of the app
     * @bodyParam secret string optional domain of the app
     * @bodyParam test_secret string optional domain of the app
     * @responseFile responses/apps/app.get.json
     * @group App
     * @param mixed $request
     * @return json
     * 
     */
    public function create(AppRequest $request)
    {
        $app = App::create($request->all());
        return $this->success($app);
    }


    /**
     * Edits record of a given app
     * Send as x-www-form-urlencoded
     * @queryParam name string required id of the app
     * @group App
     * @responseFile responses/apps/app.get.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function edit(AppEditRequest $request, $id)
    {
        $app = App::find($id);
        if(is_null($app)) return $this->notfound('App not found', 'null');
        if($app->update($request->all())){
            return $this->success($app);
        }else{
            return $this->actionFailure('could not update App');
        }
         
    }


    /**
     * Gets details of a single app using the id
     * @queryParam id string required id of the app
     * @group App
     * @responseFile responses/apps/app.get.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function getSingleApp(Request $request, $id){
        $app =  App::find($id);
        if(is_null($app)) return $this->notfound('App not found', 'null');
        return $this->success($app);
    }


    /**
     * Get all apps 
     * Other query params includes 
     * `?activated=true` which gets only the activated apps
     * `deleted` which gets the soft deleted apps
     * @group App
     * @responseFile responses/apps/apps.get.json
     * @return json
     */
    public function getApps(Request $request){
        $app = null;
        if($request->activated){
            $activated = $request->activated == "true"; 
            $app = App::where('is_active', $activated)->get();
        }else{
            $app =  App::all();
        }
        return $this->success($app);
    }


    /**
     * Deletes app from database
     * @queryParam id string required Id of the app
     * @group App
     * @responseFile responses/apps/app.delete.200.json
     * @responseFile 404 responses/apps/app.404.json
     * @responseFile 409 responses/apps/app.delete.409.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function delete(Request $request, $id){
        $app =  App::find($id);
        if(is_null($app)) return $this->notfound('App not found', 'null');
        if($app->delete()){
            return $this->actionSuccess('App deleted');
        }else{
            return $this->actionFailure('could not delete App');
        }
        
    }


    /**
     * Deletes multiple apps from database
     * Send as x-www-form-urlencoded
     * @group App
     * @responseFile responses/apps/app.delete.200.json
     * @responseFile 404 responses/apps/app.404.json
     * @bodyParam apps array required An array of id's of apps to be deleted 
     * @param mixed $request
     * @return json
     */
    public function batchDelete(Request $request){
        $deleted = 0;

        // checks if request param is an array
        if(!is_array($request->apps)){
            $errors = [
                'apps' => 'Field apps must be an array'
            ];
            return $this->validationFailed('422 unprocessible Entity', $errors);
        }

        // Gets all the apps in the array using their ids
        $apps = App::whereIn('id', $request->apps)->get();

        /** 
         * loops through the collection and deletes the apps
         *  Tracks the number of apps that was deleted as well
        */
        $apps->each(function($item, $key) use (&$deleted){
            if($item->delete()) $deleted++;
        });

        // checks if any app was deleted
        if($deleted > 0){
            return $this->actionSuccess("$deleted Apps deleted");
        }else{
            return $this->notfound('Apps not found');
        }
        
    }


    /**
     * Restore soft deleted app from database
     * @queryParam id string required Id of the app
     * @group App
     * @responseFile responses/apps/app.restore.200.json
     * @responseFile 404 responses/apps/app.404.json
     * @responseFile 409 responses/apps/app.restore.409.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function restore(Request $request, $id){
        $app =  App::onlyTrashed()->where('id', $id)->first();
        if(is_null($app)) return $this->notfound('App not found', 'null');
        if($app->restore()){
            return $this->actionSuccess('App Restored');
        }else{
            return $this->actionFailure('could not restore App');
        }
        
    }


    /**
     * Restores multiple soft deleted apps from database
     * Send as x-www-form-urlencoded
     * @group App
     * @responseFile responses/apps/app.restore.200.json
     * @responseFile 404 responses/apps/app.404.json
     * @bodyParam apps array required an array of Id's of apps to be deleted 
     * @param mixed $request
     * @return json
     * 
     */
    public function batchRestore(Request $request){
        $restored = 0;

        // checks if request param is an array
        if(!is_array($request->apps)){
            $errors = [
                'apps' => 'Field apps must be an array'
            ];
            return $this->validationFailed('422 unprocessible Entity', $errors);
        }

        // Gets all the apps in the array using their ids
        $apps = App::onlyTrashed()->whereIn('id', $request->apps)->get();

        /** 
         * loops through the collection and deletes the apps
         *  Tracks the number of apps that was restored as well
        */
        $apps->each(function($item, $key) use (&$restored){
            if($item->restore()) $restored++;
        });

        // checks if any app was restored
        if($restored > 0){
            return $this->actionSuccess("$restored Apps restored");
        }else{
            return $this->notfound('Apps not found');
        }   
    }

    /**
     * Ractivate app in database
     * @queryParam id string required Id of the app
     * @group App
     * @responseFile responses/apps/app.restore.200.json
     * @responseFile 404 responses/apps/app.404.json
     * @responseFile 409 responses/apps/app.restore.409.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function activate(Request $request, $id){
        $app =  App::find($id);
        if(is_null($app)) return $this->notfound('App not found', 'null');
         $app->is_active = true;
        if($app->save()){
            return $this->actionSuccess('App Activated');
        }else{
            return $this->actionFailure('could not activate App');
        }
        
    }

    /**
     * Ractivate app in database
     * @queryParam id string required Id of the app
     * @group App
     * @responseFile responses/apps/app.restore.200.json
     * @responseFile 404 responses/apps/app.404.json
     * @responseFile 409 responses/apps/app.restore.409.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function deactivate(Request $request, $id){
        $app =  App::find($id);
        if(is_null($app)) return $this->notfound('App not found', 'null');

        $app->is_active = false;
        if($app->save()){
            return $this->actionSuccess('App Deactivated');
        }else{
            return $this->actionFailure('could not activate App');
        }
        
    }

    
    /**
     * Activate multiple apps
     * Send as x-www-form-urlencoded
     * @group App
     * @responseFile responses/apps/app.restore.200.json
     * @responseFile 404 responses/apps/app.404.json
     * @bodyParam apps array required an array of Id's of apps to be activated 
     * @param mixed $request
     * @return json
     * 
     */
    public function batchActivate(Request $request){
        $activated = 0;

        // checks if request param is an array
        if(!is_array($request->apps)){
            $errors = [
                'apps' => 'Field apps must be an array'
            ];
            return $this->validationFailed('422 unprocessible Entity', $errors);
        }

        // Gets all the apps in the array using their ids
        $apps = App::whereIn('id', $request->apps)->get();

        /** 
         * loops through the collection and deletes the apps
         *  Tracks the number of apps that was restored as well
        */
        $apps->each(function($item, $key) use (&$activated){
            $item->is_active = true;
            if($item->save()) $activated++;
        });

        // checks if any app was restored
        if($activated > 0){
            return $this->actionSuccess("$activated Apps Activated");
        }else{
            return $this->notfound('Apps not found');
        }   
    }


    /**
     * Deactivate multiple apps
     * Send as x-www-form-urlencoded
     * @group App
     * @responseFile responses/apps/app.restore.200.json
     * @responseFile 404 responses/apps/app.404.json
     * @bodyParam apps array required an array of Id's of apps to be deactivated 
     * @param mixed $request
     * @return json
     * 
     */
    public function batchDeactivate(Request $request){
        $deactivated = 0;

        // checks if request param is an array
        if(!is_array($request->apps)){
            $errors = [
                'apps' => 'Field apps must be an array'
            ];
            return $this->validationFailed('422 unprocessible Entity', $errors);
        }

        // Gets all the apps in the array using their ids
        $apps = App::whereIn('id', $request->apps)->get();

        /** 
         * loops through the collection and deletes the apps
         *  Tracks the number of apps that was restored as well
        */
        $apps->each(function($item, $key) use (&$deactivated){
            $item->is_active = false;
            if($item->save()) $deactivated++;
        });

        // checks if any app was restored
        if($deactivated > 0){
            return $this->actionSuccess("$deactivated Apps deactivated");
        }else{
            return $this->notfound('Apps not found');
        }   
    }

}
