<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Api\V1\Requests\OrganizationRequest;
use App\Api\V1\Requests\OrganizationEditRequest;
use App\Api\V1\Requests\AppConnectRequest;
use App\Helpers\Helper;
use App\Model\V1\Organization;
use App\Model\V1\App;
use App\Resources\GenericResource;
use Tymon\JWTAuth\Facades\JWTAuth;
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
     * Connects organization to an app
     * @bodyParam custom_domain string required domain name for the service
     * @bodyParam app_id string required app id for the service
     * @responseFile responses/general/200.json {"message" : "Organization Connected to app"}
     * @responseFile 409 responses/general/409.json {"message" : "Organization already Connected to app"}
     * @responseFile 404 responses/general/404.json {"message" : "Organization does not exist"}
     * @group Organization
     * @param mixed $request
     * @return json
     * 
     */
    public function connectToApp(AppConnectRequest $request)
    {   
        $host = Helper::getRequestHost();
        $organization = Organization::where('domain_name', $host)->first();

        // checks if organization exists
        if(!$organization){
            return $this->notfound('Organization does not exist');
        }

        // checks if app has already been connected to organization
        $has_app = $organization->apps()->where('app_id', $request->app_id)->exists();
        if($has_app){
            return $this->actionFailure('Organization is already connected to App');
        }

        // attaches app to organization
        $assign = $organization->apps()->attach($request->app_id, $request->all());

        return $this->actionSuccess('Organization has been connected to app');
    }

    /**
     * Disconnects organization to an app
     * @bodyParam app_id string required app id for the service
     * @responseFile responses/general/200.json {"message" : "Organization disconnected from app"}
     * @responseFile 409 responses/general/409.json {"message" : "Organization is not Connected to app"}
     * @responseFile 404 responses/general/404.json {"message" : "Organization does not exist"}
     * @group Organization
     * @param mixed $request
     * @return json
     * 
     */
    public function disconnectToApp(Request $request)
    {   
        $host = Helper::getRequestHost();
        $organization = Organization::where('domain_name', $host)->first();

        // checks if organization exists
        if(!$organization){
            return $this->notfound('Organization does not exist');
        }

        if(!App::find($request->app_id)){
            return $this->notfound('App does not exist');
        }

        // checks if app has already been connected to organization
        $has_app = $organization->apps()->where('app_id', $request->app_id)->exists();
        if(!$has_app){
            return $this->actionFailure('Organization is not connected to App');
        }

        // attaches app to organization
        $assign = $organization->apps()->detach($request->app_id);

        return $this->actionSuccess('Organization has been disconnected from app');
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
        
        $user = Auth::guard()->setToken($request->bearerToken())->getUser();
        $token = JWTAuth::getToken();
        $payload = JWTAuth::decode($token);
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
     * @responseFile responses/general/200.json {"message" : "Organization Deleted"}
     * @responseFile 404 responses/general/404.json {"message" : "Organization not found"}
     * @responseFile 409 responses/general/409.json {"message" : "Could not delete Organization"}
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
     * @responseFile responses/general/200.json {"message" : "5 Organizations Deleted"}
     * @responseFile 404 responses/general/404.json {"message" : "Organization(s) not found"}
     * @responseFile 409 responses/general/409.json {"message" : "Could not delete Organization(s)"}
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
     * @responseFile responses/general/200.json {"message" : "Organization Restored"}
     * @responseFile 404 responses/general/404.json {"message" : "Organization not found"}
     * @responseFile 409 responses/general/409.json {"message" : "Could not restore Organization"}
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
     * @responseFile responses/general/200.json {"message" : "5 Organizations Restored"}
     * @responseFile 404 responses/general/404.json {"message" : "Organization(s) not found"}
     * @responseFile 409 responses/general/409.json {"message" : "Could not restore (s)"}
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
     * Activate organization in database
     * @queryParam id string required Id of the organization
     * @group Organization
     * @responseFile responses/general/200.json {"message" : "Organization Activated"}
     * @responseFile 404 responses/general/404.json {"message" : "Organization not found"}
     * @responseFile 409 responses/general/409.json {"message" : "Could not activate Organization"}
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
     * deactivate organization in database
     * @queryParam id string required Id of the organization
     * @group Organization
     * @responseFile responses/general/200.json {"message" : "Organization Deactivated"}
     * @responseFile 404 responses/general/404.json {"message" : "Organization not found"}
     * @responseFile 409 responses/general/409.json {"message" : "Could not deactivate Organization"}
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
     * @responseFile responses/general/200.json {"message" : "5 Organization Activated"}
     * @responseFile 404 responses/general/404.json {"message" : "Organization(s) not found"}
     * @responseFile 409 responses/general/409.json {"message" : "Could not activate Organization(s)"}
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
     * @responseFile responses/general/200.json {"message" : "5 Organization Deactivated"}
     * @responseFile 404 responses/general/404.json {"message" : "Organization(s) not found"}
     * @responseFile 409 responses/general/409.json {"message" : "Could not deactivate Organization(s)"}
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
