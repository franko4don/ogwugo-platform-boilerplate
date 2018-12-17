<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Requests\OrganizationRequest;
use App\Api\V1\Requests\OrganizationEditRequest;
use App\Helpers\Helper;
use App\Model\V1\Organization;
use App\Resources\GenericResource;
use Auth;

class Organizationcontroller extends Controller
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
     * Creates or registers and organization
     * @bodyParam name string required name of the organization
     * @bodyParam domain_name string required Domain name of the organization
     * @bodyParam motto string optional motto of the organization
     * @responseFile responses/organizations/organization.get.json
     * @group Organization
     * @param mixed $request
     * @return json
     * 
     */
    public function create(OrganizationRequest $request)
    {   
        $user = Auth::guard()->setToken($request->bearerToken())->getUser();
        $credentials = $request->only(['name', 'domain_name', 'motto']);
        $organization = $user->organization()->save(new Organization($credentials));
        return $this->success($organization);
    }

    /**
     * Edits record of a given organization
     * Send as x-www-form-urlencoded
     * @queryParam name string required id of the organization
     * @group Organization
     * @responseFile responses/organizations/organization.get.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function edit(OrganizationEditRequest $request, $id)
    {
        $organization = Organization::find($id);
        if(is_null($organization)) return $this->notfound('organization not found', 'null');
        if($organization->update($request->all())){
            return $this->success($organization);
        }else{
            return $this->actionFailure('could not update organization');
        }
         
    }


    /**
     * Gets details of a single organization using the id
     * @queryParam id string required id of the organization
     * @group Organization
     * @responseFile responses/organizations/organization.get.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function getSingleOrganization(Request $request, $id)
    {
        $organization =  Organization::find($id);
        if(is_null($organization)) return $this->notfound('organization not found', 'null');
        return $this->success($organization);
    }


    /**
     * Get all organizations 
     * Other query params includes 
     * `?activated=true` which gets only the activated organizations
     * `deleted` which gets the soft deleted organizations
     * @group Organization
     * @responseFile responses/organizations/organizations.get.json
     * @return json
     */
    public function getOrganizations(Request $request)
    {
        $organization = null;
        if($request->activated){
            $activated = $request->activated == "true"; 
            $organization = Organization::where('is_active', $activated)->get();
        }else{
            $organization =  Organization::all();
        }
        return $this->success($organization);
    }


    /**
     * Deletes organization from database
     * @queryParam id string required Id of the organization
     * @group Organization
     * @responseFile responses/organizations/organization.delete.200.json
     * @responseFile 404 responses/organizations/organization.404.json
     * @responseFile 409 responses/organizations/organization.delete.409.json
     * @param mixed $request
     * @param string $id
     * @return json
     */
    public function delete(Request $request, $id)
    {
        $organization =  Organization::find($id);
        if(is_null($organization)) return $this->notfound('organization not found', 'null');
        if($organization->delete()){
            return $this->actionSuccess('organization deleted');
        }else{
            return $this->actionFailure('could not delete organization');
        }
        
    }


    /**
     * Deletes multiple organizations from database
     * Send as x-www-form-urlencoded
     * @group Organization
     * @responseFile responses/organizations/organization.delete.200.json
     * @responseFile 404 responses/organizations/organization.404.json
     * @bodyParam organizations array required An array of id's of organizations to be deleted 
     * @param mixed $request
     * @return json
     */
    public function batchDelete(Request $request)
    {
        $deleted = 0;

        // checks if request param is an array
        if(!is_array($request->organizations)){
            $errors = [
                'organizations' => 'Field organizations must be an array'
            ];
            return $this->validationFailed('422 unprocessible Entity', $errors);
        }

        // Gets all the organizations in the array using their ids
        $organizations = Organization::whereIn('id', $request->organizations)->get();

        /** 
         * loops through the collection and deletes the organizations
         *  Tracks the number of organizations that was deleted as well
        */
        $organizations->each(function($item, $key) use (&$deleted){
            if($item->delete()) $deleted++;
        });

        // checks if any organization was deleted
        if($deleted > 0){
            return $this->actionSuccess("$deleted organization(s) deleted");
        }else{
            return $this->notfound('organizations not found');
        }
        
    }


    /**
     * Restore soft deleted organization from database
     * @queryParam id string required Id of the organization
     * @group Organization
     * @responseFile responses/organizations/organization.restore.200.json
     * @responseFile 404 responses/organizations/organization.404.json
     * @responseFile 409 responses/organizations/organization.restore.409.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function restore(Request $request, $id)
    {
        $organization =  Organization::onlyTrashed()->where('id', $id)->first();
        if(is_null($organization)) return $this->notfound('organization not found', 'null');
        if($organization->restore()){
            return $this->actionSuccess('organization Restored');
        }else{
            return $this->actionFailure('could not restore organization');
        }
        
    }


    /**
     * Restores multiple soft deleted organizations from database
     * Send as x-www-form-urlencoded
     * @group Organization
     * @responseFile responses/organizations/organization.restore.200.json
     * @responseFile 404 responses/organizations/organization.404.json
     * @bodyParam organizations array required an array of Id's of organizations to be deleted 
     * @param mixed $request
     * @return json
     * 
     */
    public function batchRestore(Request $request)
    {
        $restored = 0;

        // checks if request param is an array
        if(!is_array($request->organizations)){
            $errors = [
                'organizations' => 'Field organizations must be an array'
            ];
            return $this->validationFailed('422 unprocessible Entity', $errors);
        }

        // Gets all the organizations in the array using their ids
        $organizations = Organization::onlyTrashed()->whereIn('id', $request->organizations)->get();

        /** 
         * loops through the collection and deletes the organizations
         *  Tracks the number of organizations that was restored as well
        */
        $organizations->each(function($item, $key) use (&$restored){
            if($item->restore()) $restored++;
        });

        // checks if any organization was restored
        if($restored > 0){
            return $this->actionSuccess("$restored organizations restored");
        }else{
            return $this->notfound('organizations not found');
        }   
    }


    /**
     * Ractivate organization in database
     * @queryParam id string required Id of the organization
     * @group Organization
     * @responseFile responses/organizations/organization.restore.200.json
     * @responseFile 404 responses/organizations/organization.404.json
     * @responseFile 409 responses/organizations/organization.restore.409.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function activate(Request $request, $id)
    {
        $organization =  Organization::find($id);
        if(is_null($organization)) return $this->notfound('organization not found', 'null');
         $organization->is_active = true;
        if($organization->save()){
            return $this->actionSuccess('organization Activated');
        }else{
            return $this->actionFailure('could not activate organization');
        }
        
    }

    /**
     * Ractivate organization in database
     * @queryParam id string required Id of the organization
     * @group Organization
     * @responseFile responses/organizations/organization.restore.200.json
     * @responseFile 404 responses/organizations/organization.404.json
     * @responseFile 409 responses/organizations/organization.restore.409.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function deactivate(Request $request, $id)
    {
        $organization =  Organization::find($id);
        if(is_null($organization)) return $this->notfound('organization not found', 'null');

        $organization->is_active = false;
        if($organization->save()){
            return $this->actionSuccess('organization Deactivated');
        }else{
            return $this->actionFailure('could not activate organization');
        }
        
    }

    
    /**
     * Activate multiple organizations
     * Send as x-www-form-urlencoded
     * @group Organization
     * @responseFile responses/organizations/organization.restore.200.json
     * @responseFile 404 responses/organizations/organization.404.json
     * @bodyParam organizations array required an array of Id's of organizations to be activated 
     * @param mixed $request
     * @return json
     * 
     */
    public function batchActivate(Request $request)
    {
        $activated = 0;

        // checks if request param is an array
        if(!is_array($request->organizations)){
            $errors = [
                'organizations' => 'Field organizations must be an array'
            ];
            return $this->validationFailed('422 unprocessible Entity', $errors);
        }

        // Gets all the organizations in the array using their ids
        $organizations = Organization::whereIn('id', $request->organizations)->get();

        /** 
         * loops through the collection and deletes the organizations
         *  Tracks the number of organizations that was restored as well
        */
        $organizations->each(function($item, $key) use (&$activated){
            $item->is_active = true;
            if($item->save()) $activated++;
        });

        // checks if any organization was restored
        if($activated > 0){
            return $this->actionSuccess("$activated organizations Activated");
        }else{
            return $this->notfound('organizations not found');
        }   
    }


    /**
     * Deactivate multiple organizations
     * Send as x-www-form-urlencoded
     * @group Organization
     * @responseFile responses/organizations/organization.restore.200.json
     * @responseFile 404 responses/organizations/organization.404.json
     * @bodyParam organizations array required an array of Id's of organizations to be deactivated 
     * @param mixed $request
     * @return json
     * 
     */
    public function batchDeactivate(Request $request)
    {
        $deactivated = 0;

        // checks if request param is an array
        if(!is_array($request->organizations)){
            $errors = [
                'organizations' => 'Field organizations must be an array'
            ];
            return $this->validationFailed('422 unprocessible Entity', $errors);
        }

        // Gets all the organizations in the array using their ids
        $organizations = Organization::whereIn('id', $request->organizations)->get();

        /** 
         * loops through the collection and deletes the organizations
         *  Tracks the number of organizations that was restored as well
        */
        $organizations->each(function($item, $key) use (&$deactivated){
            $item->is_active = false;
            if($item->save()) $deactivated++;
        });

        // checks if any organization was restored
        if($deactivated > 0){
            return $this->actionSuccess("$deactivated organizations deactivated");
        }else{
            return $this->notfound('organizations not found');
        }   
    }
}
