<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Api\V1\Requests\FeatureRequest;
use App\Model\V1\Feature;
use App\Resources\GenericResource;
use Auth;

class Featurecontroller extends Controller
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
     * Creates or registers Feature
     * @bodyParam name string required name of the Feature
     * @bodyParam description string required Description of the Feature
     * @responseFile responses/features/feature.get.json
     * @group Feature
     * @param mixed $request
     * @return json
     * 
     */
    public function create(FeatureRequest $request)
    {   
        $user = Auth::guard()->setToken(request()->bearerToken())->getUser();
        $credentials = $request->only(['name', 'description']);
        $feature = new Feature($credentials);
        $feature = $user->featureCreatedBy()->save($feature);
        return $this->success($feature);
    }

    /**
     * Edits record of a given Feature
     * Send as x-www-form-urlencoded
     * @queryParam name string required id of the Feature
     * @group Feature
     * @responseFile responses/features/feature.get.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function edit(FeatureRequest $request, $id)
    {
        $feature = Feature::find($id);
        $user = Auth::guard()->setToken(request()->bearerToken())->getUser();
        if(is_null($feature)) return $this->notfound('Feature not found', 'null');
        $merge = array_merge($request->all(), ['updated_by' => $user->id]);
        if($feature->update($merge)){
            return $this->success($feature);
        }else{
            return $this->actionFailure('could not update Feature');
        }
         
    }


    /**
     * Gets details of a single Feature using the id
     * @queryParam id string required id of the Feature
     * @group Feature
     * @responseFile responses/features/feature.get.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function getSingleFeature(Request $request, $id)
    {
        $feature =  Feature::find($id);
        if(is_null($feature)) return $this->notfound('Feature not found', 'null');
        return $this->success($feature);
    }


    /**
     * Get all Features 
     * Other query params includes 
     * `?activated=true` which gets only the activated Features
     * `deleted` which gets the soft deleted Features
     * @group Feature
     * @responseFile responses/features/features.get.json
     * @return json
     */
    public function getFeatures(Request $request)
    {
        $feature = null;
        if($request->activated){
            $activated = $request->activated == "true"; 
            $feature = Feature::where('is_active', $activated)->get();
        }else{
            $feature =  Feature::all();
        }
        return $this->success($feature);
    }


    /**
     * Deletes Feature from database
     * @queryParam id string required Id of the Feature
     * @group Feature
     * @responseFile responses/features/feature.delete.200.json
     * @responseFile 404 responses/features/feature.404.json
     * @responseFile 409 responses/features/feature.delete.409.json
     * @param mixed $request
     * @param string $id
     * @return json
     */
    public function delete(Request $request, $id)
    {
        $feature =  Feature::find($id);
        if(is_null($feature)) return $this->notfound('Feature not found', 'null');
        if($feature->delete()){
            return $this->actionSuccess('Feature deleted');
        }else{
            return $this->actionFailure('could not delete Feature');
        }
        
    }


    /**
     * Deletes multiple Features from database
     * Send as x-www-form-urlencoded
     * @group Feature
     * @responseFile responses/features/feature.delete.200.json
     * @responseFile 404 responses/features/feature.404.json
     * @bodyParam Features array required An array of id's of Features to be deleted 
     * @param mixed $request
     * @return json
     */
    public function batchDelete(Request $request)
    {
        $deleted = 0;

        // checks if request param is an array
        if(!is_array($request->features)){
            $errors = [
                'Features' => 'Field features must be an array'
            ];
            return $this->validationFailed('422 unprocessible Entity', $errors);
        }

        // Gets all the Features in the array using their ids
        $features = Feature::whereIn('id', $request->features)->get();

        /** 
         * loops through the collection and deletes the Features
         *  Tracks the number of Features that was deleted as well
        */
        $features->each(function($item, $key) use (&$deleted){
            if($item->delete()) $deleted++;
        });

        // checks if any Feature was deleted
        if($deleted > 0){
            return $this->actionSuccess("$deleted Feature(s) deleted");
        }else{
            return $this->notfound('Features not found');
        }
        
    }


    /**
     * Restore soft deleted Feature from database
     * @queryParam id string required Id of the Feature
     * @group Feature
     * @responseFile responses/features/feature.restore.200.json
     * @responseFile 404 responses/features/feature.404.json
     * @responseFile 409 responses/features/feature.restore.409.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function restore(Request $request, $id)
    {
        $feature =  Feature::onlyTrashed()->where('id', $id)->first();
        if(is_null($feature)) return $this->notfound('Feature not found', 'null');
        if($feature->restore()){
            return $this->actionSuccess('Feature Restored');
        }else{
            return $this->actionFailure('could not restore Feature');
        }
        
    }


    /**
     * Restores multiple soft deleted Features from database
     * Send as x-www-form-urlencoded
     * @group Feature
     * @responseFile responses/features/feature.restore.200.json
     * @responseFile 404 responses/features/feature.404.json
     * @bodyParam Features array required an array of Id's of Features to be deleted 
     * @param mixed $request
     * @return json
     * 
     */
    public function batchRestore(Request $request)
    {
        $restored = 0;

        // checks if request param is an array
        if(!is_array($request->features)){
            $errors = [
                'Features' => 'Field Features must be an array'
            ];
            return $this->validationFailed('422 unprocessible Entity', $errors);
        }

        // Gets all the Features in the array using their ids
        $features = Feature::onlyTrashed()->whereIn('id', $request->features)->get();

        /** 
         * loops through the collection and deletes the Features
         *  Tracks the number of Features that was restored as well
        */
        $features->each(function($item, $key) use (&$restored){
            if($item->restore()) $restored++;
        });

        // checks if any Feature was restored
        if($restored > 0){
            return $this->actionSuccess("$restored Features restored");
        }else{
            return $this->notfound('Features not found');
        }   
    }


    /**
     * Ractivate Feature in database
     * @queryParam id string required Id of the Feature
     * @group Feature
     * @responseFile responses/features/feature.restore.200.json
     * @responseFile 404 responses/features/feature.404.json
     * @responseFile 409 responses/features/feature.restore.409.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function activate(Request $request, $id)
    {
        $feature =  Feature::find($id);
        $user = Auth::guard()->setToken(request()->bearerToken())->getUser();
        if(is_null($feature)) return $this->notfound('Feature not found', 'null');
         $feature->is_active = true;
         $feature->activated_by = $user->id;
        if($feature->save()){
            return $this->actionSuccess('Feature Activated');
        }else{
            return $this->actionFailure('could not activate Feature');
        }
        
    }

    /**
     * Ractivate Feature in database
     * @queryParam id string required Id of the Feature
     * @group Feature
     * @responseFile responses/features/feature.restore.200.json
     * @responseFile 404 responses/features/feature.404.json
     * @responseFile 409 responses/features/feature.restore.409.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function deactivate(Request $request, $id)
    {
        $feature =  Feature::find($id);
        if(is_null($feature)) return $this->notfound('Feature not found', 'null');

        $feature->is_active = false;
        if($feature->save()){
            return $this->actionSuccess('Feature Deactivated');
        }else{
            return $this->actionFailure('could not activate Feature');
        }
        
    }

    
    /**
     * Activate multiple Features
     * Send as x-www-form-urlencoded
     * @group Feature
     * @responseFile responses/features/feature.restore.200.json
     * @responseFile 404 responses/features/feature.404.json
     * @bodyParam Features array required an array of Id's of Features to be activated 
     * @param mixed $request
     * @return json
     * 
     */
    public function batchActivate(Request $request)
    {
        $activated = 0;

        // checks if request param is an array
        if(!is_array($request->features)){
            $errors = [
                'Features' => 'Field Features must be an array'
            ];
            return $this->validationFailed('422 unprocessible Entity', $errors);
        }

        // Gets all the Features in the array using their ids
        $features = Feature::whereIn('id', $request->features)->get();

        /** 
         * loops through the collection and deletes the Features
         *  Tracks the number of Features that was restored as well
        */
        $features->each(function($item, $key) use (&$activated){
            $item->is_active = true;
            if($item->save()) $activated++;
        });

        // checks if any Feature was restored
        if($activated > 0){
            return $this->actionSuccess("$activated Features Activated");
        }else{
            return $this->notfound('Features not found');
        }   
    }


    /**
     * Deactivate multiple Features
     * Send as x-www-form-urlencoded
     * @group Feature
     * @responseFile responses/features/feature.restore.200.json
     * @responseFile 404 responses/features/feature.404.json
     * @bodyParam Features array required an array of Id's of Features to be deactivated 
     * @param mixed $request
     * @return json
     * 
     */
    public function batchDeactivate(Request $request)
    {
        $deactivated = 0;

        // checks if request param is an array
        if(!is_array($request->features)){
            $errors = [
                'Features' => 'Field Features must be an array'
            ];
            return $this->validationFailed('422 unprocessible Entity', $errors);
        }

        // Gets all the Features in the array using their ids
        $features = Feature::whereIn('id', $request->features)->get();

        /** 
         * loops through the collection and deletes the Features
         *  Tracks the number of Features that was restored as well
        */
        $features->each(function($item, $key) use (&$deactivated){
            $item->is_active = false;
            if($item->save()) $deactivated++;
        });

        // checks if any Feature was restored
        if($deactivated > 0){
            return $this->actionSuccess("$deactivated Features deactivated");
        }else{
            return $this->notfound('Features not found');
        }   
    }
}
