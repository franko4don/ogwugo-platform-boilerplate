<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Helpers\Http;
use App\Api\V1\Requests\OrganizationUserRequest;
use App\Model\V1\OrganizationUser;
use App\Resources\GenericResource;
use Auth;
use App\Model\V1\User;
use URL;

class OrganizationUserController extends Controller
{
    
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth')->except(['register']);
    }


    /**
     * Creates or registers and OrganizationUser
     * @bodyParam name string required name of the OrganizationUser
     * @bodyParam domain_name string required Domain name of the OrganizationUser
     * @bodyParam motto string optional motto of the OrganizationUser
     * @responseFile responses/organizationusers/organizationuser.get.json
     * @group OrganizationUser
     * @param mixed $request
     * @return json
     * 
     */
    public function register(OrganizationUserRequest $request)
    {   
        
        $user = User::where('email', $request->email)->first();
        URL::setRootControllerNamespace('App\Api\V1\Controllers\Authy');
        if(is_null($user)){
            $url = action('SignUpController@signUpFromOrganization');
            
            $response = Http::post($url, ['json' => json_encode($request->all())]);
            dd($response);
        }

        return $this->success($user);
    }

    /**
     * Edits record of a given OrganizationUser
     * Send as x-www-form-urlencoded
     * @queryParam name string required id of the OrganizationUser
     * @group OrganizationUser
     * @responseFile responses/organizationusers/organizationuser.get.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function edit(OrganizationUserRequest $request, $id)
    {
        $organization_user = OrganizationUser::find($id);
        if(is_null($organization_user)) return $this->notfound('OrganizationUser not found', 'null');
        if($organization_user->update($request->all())){
            return $this->success($organization_user);
        }else{
            return $this->actionFailure('could not update OrganizationUser');
        }
         
    }


    /**
     * Gets details of a single OrganizationUser using the id
     * @queryParam id string required id of the OrganizationUser
     * @group OrganizationUser
     * @responseFile responses/organizationusers/organizationuser.get.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function getSingleOrganizationUser(Request $request, $id)
    {
        $organization_user =  OrganizationUser::find($id);
        if(is_null($organization_user)) return $this->notfound('OrganizationUser not found', 'null');
        return $this->success($organization_user);
    }


    /**
     * Get all OrganizationUsers 
     * Other query params includes 
     * `?activated=true` which gets only the activated OrganizationUsers
     * `deleted` which gets the soft deleted OrganizationUsers
     * @group OrganizationUser
     * @responseFile responses/organizationusers/organizationusers.get.json
     * @return json
     */
    public function getOrganizationUsers(Request $request)
    {
        $organization_user = null;
        if($request->activated){
            $activated = $request->activated == "true"; 
            $organization_user = OrganizationUser::where('is_active', $activated)->get();
        }else{
            $organization_user =  OrganizationUser::all();
        }
        return $this->success($organization_user);
    }


    /**
     * Deletes OrganizationUser from database
     * @queryParam id string required Id of the OrganizationUser
     * @group OrganizationUser
     * @responseFile responses/organizationusers/organizationuser.delete.200.json
     * @responseFile 404 responses/organizationusers/organizationuser.404.json
     * @responseFile 409 responses/organizationusers/organizationuser.delete.409.json
     * @param mixed $request
     * @param string $id
     * @return json
     */
    public function delete(Request $request, $id)
    {
        $organization_user =  OrganizationUser::find($id);
        if(is_null($organization_user)) return $this->notfound('OrganizationUser not found', 'null');
        if($organization_user->delete()){
            return $this->actionSuccess('OrganizationUser deleted');
        }else{
            return $this->actionFailure('could not delete OrganizationUser');
        }
        
    }


    /**
     * Deletes multiple OrganizationUsers from database
     * Send as x-www-form-urlencoded
     * @group OrganizationUser
     * @responseFile responses/organizationusers/organizationuser.delete.200.json
     * @responseFile 404 responses/organizationusers/organizationuser.404.json
     * @bodyParam OrganizationUsers array required An array of id's of OrganizationUsers to be deleted 
     * @param mixed $request
     * @return json
     */
    public function batchDelete(Request $request)
    {
        $deleted = 0;

        // checks if request param is an array
        if(!is_array($request->organization_users)){
            $errors = [
                'OrganizationUsers' => 'Field OrganizationUsers must be an array'
            ];
            return $this->validationFailed('422 unprocessible Entity', $errors);
        }

        // Gets all the OrganizationUsers in the array using their ids
        $organization_users = OrganizationUser::whereIn('id', $request->organization_users)->get();

        /** 
         * loops through the collection and deletes the OrganizationUsers
         *  Tracks the number of OrganizationUsers that was deleted as well
        */
        $organization_users->each(function($item, $key) use (&$deleted){
            if($item->delete()) $deleted++;
        });

        // checks if any OrganizationUser was deleted
        if($deleted > 0){
            return $this->actionSuccess("$deleted OrganizationUser(s) deleted");
        }else{
            return $this->notfound('OrganizationUsers not found');
        }
        
    }


    /**
     * Restore soft deleted OrganizationUser from database
     * @queryParam id string required Id of the OrganizationUser
     * @group OrganizationUser
     * @responseFile responses/organizationusers/organizationuser.restore.200.json
     * @responseFile 404 responses/organizationusers/organizationuser.404.json
     * @responseFile 409 responses/organizationusers/organizationuser.restore.409.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function restore(Request $request, $id)
    {
        $organization_user =  OrganizationUser::onlyTrashed()->where('id', $id)->first();
        if(is_null($organization_user)) return $this->notfound('OrganizationUser not found', 'null');
        if($organization_user->restore()){
            return $this->actionSuccess('OrganizationUser Restored');
        }else{
            return $this->actionFailure('could not restore OrganizationUser');
        }
        
    }


    /**
     * Restores multiple soft deleted OrganizationUsers from database
     * Send as x-www-form-urlencoded
     * @group OrganizationUser
     * @responseFile responses/organizationusers/organizationuser.restore.200.json
     * @responseFile 404 responses/organizationusers/organizationuser.404.json
     * @bodyParam OrganizationUsers array required an array of Id's of OrganizationUsers to be deleted 
     * @param mixed $request
     * @return json
     * 
     */
    public function batchRestore(Request $request)
    {
        $restored = 0;

        // checks if request param is an array
        if(!is_array($request->organization_users)){
            $errors = [
                'OrganizationUsers' => 'Field OrganizationUsers must be an array'
            ];
            return $this->validationFailed('422 unprocessible Entity', $errors);
        }

        // Gets all the OrganizationUsers in the array using their ids
        $organization_users = OrganizationUser::onlyTrashed()->whereIn('id', $request->organization_users)->get();

        /** 
         * loops through the collection and deletes the OrganizationUsers
         *  Tracks the number of OrganizationUsers that was restored as well
        */
        $organization_users->each(function($item, $key) use (&$restored){
            if($item->restore()) $restored++;
        });

        // checks if any OrganizationUser was restored
        if($restored > 0){
            return $this->actionSuccess("$restored OrganizationUsers restored");
        }else{
            return $this->notfound('OrganizationUsers not found');
        }   
    }


    /**
     * Ractivate OrganizationUser in database
     * @queryParam id string required Id of the OrganizationUser
     * @group OrganizationUser
     * @responseFile responses/organizationusers/organizationuser.restore.200.json
     * @responseFile 404 responses/organizationusers/organizationuser.404.json
     * @responseFile 409 responses/organizationusers/organizationuser.restore.409.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function activate(Request $request, $id)
    {
        $organization_user =  OrganizationUser::find($id);
        if(is_null($organization_user)) return $this->notfound('OrganizationUser not found', 'null');
         $organization_user->is_active = true;
        if($organization_user->save()){
            return $this->actionSuccess('OrganizationUser Activated');
        }else{
            return $this->actionFailure('could not activate OrganizationUser');
        }
        
    }

    /**
     * Ractivate OrganizationUser in database
     * @queryParam id string required Id of the OrganizationUser
     * @group OrganizationUser
     * @responseFile responses/organizationusers/organizationuser.restore.200.json
     * @responseFile 404 responses/organizationusers/organizationuser.404.json
     * @responseFile 409 responses/organizationusers/organizationuser.restore.409.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function deactivate(Request $request, $id)
    {
        $organization_user =  OrganizationUser::find($id);
        if(is_null($organization_user)) return $this->notfound('OrganizationUser not found', 'null');

        $organization_user->is_active = false;
        if($organization_user->save()){
            return $this->actionSuccess('OrganizationUser Deactivated');
        }else{
            return $this->actionFailure('could not activate OrganizationUser');
        }
        
    }

    
    /**
     * Activate multiple OrganizationUsers
     * Send as x-www-form-urlencoded
     * @group OrganizationUser
     * @responseFile responses/organizationusers/organizationuser.restore.200.json
     * @responseFile 404 responses/organizationusers/organizationuser.404.json
     * @bodyParam OrganizationUsers array required an array of Id's of OrganizationUsers to be activated 
     * @param mixed $request
     * @return json
     * 
     */
    public function batchActivate(Request $request)
    {
        $activated = 0;

        // checks if request param is an array
        if(!is_array($request->organization_users)){
            $errors = [
                'OrganizationUsers' => 'Field OrganizationUsers must be an array'
            ];
            return $this->validationFailed('422 unprocessible Entity', $errors);
        }

        // Gets all the OrganizationUsers in the array using their ids
        $organization_users = OrganizationUser::whereIn('id', $request->organization_users)->get();

        /** 
         * loops through the collection and deletes the OrganizationUsers
         *  Tracks the number of OrganizationUsers that was restored as well
        */
        $organization_users->each(function($item, $key) use (&$activated){
            $item->is_active = true;
            if($item->save()) $activated++;
        });

        // checks if any OrganizationUser was restored
        if($activated > 0){
            return $this->actionSuccess("$activated OrganizationUsers Activated");
        }else{
            return $this->notfound('OrganizationUsers not found');
        }   
    }


    /**
     * Deactivate multiple OrganizationUsers
     * Send as x-www-form-urlencoded
     * @group OrganizationUser
     * @responseFile responses/organizationusers/organizationuser.restore.200.json
     * @responseFile 404 responses/organizationusers/organizationuser.404.json
     * @bodyParam OrganizationUsers array required an array of Id's of OrganizationUsers to be deactivated 
     * @param mixed $request
     * @return json
     */
    public function batchDeactivate(Request $request)
    {
        $deactivated = 0;

        // checks if request param is an array
        if(!is_array($request->organization_users)){
            $errors = [
                'OrganizationUsers' => 'Field OrganizationUsers must be an array'
            ];
            return $this->validationFailed('422 unprocessible Entity', $errors);
        }

        // Gets all the OrganizationUsers in the array using their ids
        $organization_users = OrganizationUser::whereIn('id', $request->organization_users)->get();

        /** 
         * loops through the collection and deletes the OrganizationUsers
         *  Tracks the number of OrganizationUsers that was restored as well
        */
        $organization_users->each(function($item, $key) use (&$deactivated){
            $item->is_active = false;
            if($item->save()) $deactivated++;
        });

        // checks if any OrganizationUser was restored
        if($deactivated > 0){
            return $this->actionSuccess("$deactivated OrganizationUsers deactivated");
        }else{
            return $this->notfound('OrganizationUsers not found');
        }   
    }
}
