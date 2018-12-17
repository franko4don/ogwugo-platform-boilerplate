<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Api\V1\Requests\SubscriptionRequest;
use App\Model\V1\Subscription;
use App\Resources\GenericResource;
use Auth;


class Subscriptioncontroller extends Controller
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
     * Creates or registers and Subscription
     * @bodyParam name string required name of the Subscription
     * @bodyParam domain_name string required Domain name of the Subscription
     * @bodyParam motto string optional motto of the Subscription
     * @responseFile responses/subscriptions/subscription.get.json
     * @group Subscription
     * @param mixed $request
     * @return json
     * 
     */
    public function create(SubscriptionRequest $request)
    {   
        
        $user = Auth::guard()->setToken($request->bearerToken())->getUser();
        $credentials = $request->only(['name', 'description', 'price', 'duration']);
        $subscription = $user->subscriptionCreatedBy()->save(new Subscription($credentials));
        return $this->success($subscription);
    }

    /**
     * Edits record of a given Subscription
     * Send as x-www-form-urlencoded
     * @queryParam name string required id of the Subscription
     * @group Subscription
     * @responseFile responses/subscriptions/subscription.get.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function edit(SubscriptionRequest $request, $id)
    {
        $subscription = Subscription::find($id);
        if(is_null($subscription)) return $this->notfound('Subscription not found', 'null');
        if($subscription->update($request->all())){
            return $this->success($subscription);
        }else{
            return $this->actionFailure('could not update Subscription');
        }
         
    }


    /**
     * Gets details of a single Subscription using the id
     * @queryParam id string required id of the Subscription
     * @group Subscription
     * @responseFile responses/subscriptions/subscription.get.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function getSingleSubscription(Request $request, $id)
    {
        $subscription =  Subscription::find($id);
        if(is_null($subscription)) return $this->notfound('Subscription not found', 'null');
        return $this->success($subscription);
    }


    /**
     * Get all Subscriptions 
     * Other query params includes 
     * `?activated=true` which gets only the activated Subscriptions
     * `deleted` which gets the soft deleted Subscriptions
     * @group Subscription
     * @responseFile responses/subscriptions/subscriptions.get.json
     * @return json
     */
    public function getSubscriptions(Request $request)
    {
        $subscription = null;
        if($request->activated){
            $activated = $request->activated == "true"; 
            $subscription = Subscription::where('is_active', $activated)->get();
        }else{
            $subscription =  Subscription::all();
        }
        return $this->success($subscription);
    }


    /**
     * Deletes Subscription from database
     * @queryParam id string required Id of the Subscription
     * @group Subscription
     * @responseFile responses/subscriptions/subscription.delete.200.json
     * @responseFile 404 responses/subscriptions/subscription.404.json
     * @responseFile 409 responses/subscriptions/subscription.delete.409.json
     * @param mixed $request
     * @param string $id
     * @return json
     */
    public function delete(Request $request, $id)
    {
        $subscription =  Subscription::find($id);
        if(is_null($subscription)) return $this->notfound('Subscription not found', 'null');
        if($subscription->delete()){
            return $this->actionSuccess('Subscription deleted');
        }else{
            return $this->actionFailure('could not delete Subscription');
        }
        
    }


    /**
     * Deletes multiple Subscriptions from database
     * Send as x-www-form-urlencoded
     * @group Subscription
     * @responseFile responses/subscriptions/subscription.delete.200.json
     * @responseFile 404 responses/subscriptions/subscription.404.json
     * @bodyParam Subscriptions array required An array of id's of Subscriptions to be deleted 
     * @param mixed $request
     * @return json
     */
    public function batchDelete(Request $request)
    {
        $deleted = 0;

        // checks if request param is an array
        if(!is_array($request->subscriptions)){
            $errors = [
                'Subscriptions' => 'Field Subscriptions must be an array'
            ];
            return $this->validationFailed('422 unprocessible Entity', $errors);
        }

        // Gets all the Subscriptions in the array using their ids
        $subscriptions = Subscription::whereIn('id', $request->subscriptions)->get();

        /** 
         * loops through the collection and deletes the Subscriptions
         *  Tracks the number of Subscriptions that was deleted as well
        */
        $subscriptions->each(function($item, $key) use (&$deleted){
            if($item->delete()) $deleted++;
        });

        // checks if any Subscription was deleted
        if($deleted > 0){
            return $this->actionSuccess("$deleted Subscription(s) deleted");
        }else{
            return $this->notfound('Subscriptions not found');
        }
        
    }


    /**
     * Restore soft deleted Subscription from database
     * @queryParam id string required Id of the Subscription
     * @group Subscription
     * @responseFile responses/subscriptions/subscription.restore.200.json
     * @responseFile 404 responses/subscriptions/subscription.404.json
     * @responseFile 409 responses/subscriptions/subscription.restore.409.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function restore(Request $request, $id)
    {
        $subscription =  Subscription::onlyTrashed()->where('id', $id)->first();
        if(is_null($subscription)) return $this->notfound('Subscription not found', 'null');
        if($subscription->restore()){
            return $this->actionSuccess('Subscription Restored');
        }else{
            return $this->actionFailure('could not restore Subscription');
        }
        
    }


    /**
     * Restores multiple soft deleted Subscriptions from database
     * Send as x-www-form-urlencoded
     * @group Subscription
     * @responseFile responses/subscriptions/subscription.restore.200.json
     * @responseFile 404 responses/subscriptions/subscription.404.json
     * @bodyParam Subscriptions array required an array of Id's of Subscriptions to be deleted 
     * @param mixed $request
     * @return json
     * 
     */
    public function batchRestore(Request $request)
    {
        $restored = 0;

        // checks if request param is an array
        if(!is_array($request->subscriptions)){
            $errors = [
                'Subscriptions' => 'Field Subscriptions must be an array'
            ];
            return $this->validationFailed('422 unprocessible Entity', $errors);
        }

        // Gets all the Subscriptions in the array using their ids
        $subscriptions = Subscription::onlyTrashed()->whereIn('id', $request->subscriptions)->get();

        /** 
         * loops through the collection and deletes the Subscriptions
         *  Tracks the number of Subscriptions that was restored as well
        */
        $subscriptions->each(function($item, $key) use (&$restored){
            if($item->restore()) $restored++;
        });

        // checks if any Subscription was restored
        if($restored > 0){
            return $this->actionSuccess("$restored Subscriptions restored");
        }else{
            return $this->notfound('Subscriptions not found');
        }   
    }


    /**
     * Ractivate Subscription in database
     * @queryParam id string required Id of the Subscription
     * @group Subscription
     * @responseFile responses/subscriptions/subscription.restore.200.json
     * @responseFile 404 responses/subscriptions/subscription.404.json
     * @responseFile 409 responses/subscriptions/subscription.restore.409.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function activate(Request $request, $id)
    {
        $subscription =  Subscription::find($id);
        if(is_null($subscription)) return $this->notfound('Subscription not found', 'null');
         $subscription->is_active = true;
        if($subscription->save()){
            return $this->actionSuccess('Subscription Activated');
        }else{
            return $this->actionFailure('could not activate Subscription');
        }
        
    }

    /**
     * Ractivate Subscription in database
     * @queryParam id string required Id of the Subscription
     * @group Subscription
     * @responseFile responses/subscriptions/subscription.restore.200.json
     * @responseFile 404 responses/subscriptions/subscription.404.json
     * @responseFile 409 responses/subscriptions/subscription.restore.409.json
     * @param mixed $request
     * @param string $id
     * @return json
     * 
     */
    public function deactivate(Request $request, $id)
    {
        $subscription =  Subscription::find($id);
        if(is_null($subscription)) return $this->notfound('Subscription not found', 'null');

        $subscription->is_active = false;
        if($subscription->save()){
            return $this->actionSuccess('Subscription Deactivated');
        }else{
            return $this->actionFailure('could not activate Subscription');
        }
        
    }

    
    /**
     * Activate multiple Subscriptions
     * Send as x-www-form-urlencoded
     * @group Subscription
     * @responseFile responses/subscriptions/subscription.restore.200.json
     * @responseFile 404 responses/subscriptions/subscription.404.json
     * @bodyParam Subscriptions array required an array of Id's of Subscriptions to be activated 
     * @param mixed $request
     * @return json
     * 
     */
    public function batchActivate(Request $request)
    {
        $activated = 0;

        // checks if request param is an array
        if(!is_array($request->subscriptions)){
            $errors = [
                'Subscriptions' => 'Field Subscriptions must be an array'
            ];
            return $this->validationFailed('422 unprocessible Entity', $errors);
        }

        // Gets all the Subscriptions in the array using their ids
        $subscriptions = Subscription::whereIn('id', $request->subscriptions)->get();

        /** 
         * loops through the collection and deletes the Subscriptions
         *  Tracks the number of Subscriptions that was restored as well
        */
        $subscriptions->each(function($item, $key) use (&$activated){
            $item->is_active = true;
            if($item->save()) $activated++;
        });

        // checks if any Subscription was restored
        if($activated > 0){
            return $this->actionSuccess("$activated Subscriptions Activated");
        }else{
            return $this->notfound('Subscriptions not found');
        }   
    }


    /**
     * Deactivate multiple Subscriptions
     * Send as x-www-form-urlencoded
     * @group Subscription
     * @responseFile responses/subscriptions/subscription.restore.200.json
     * @responseFile 404 responses/subscriptions/subscription.404.json
     * @bodyParam Subscriptions array required an array of Id's of Subscriptions to be deactivated 
     * @param mixed $request
     * @return json
     * 
     */
    public function batchDeactivate(Request $request)
    {
        $deactivated = 0;

        // checks if request param is an array
        if(!is_array($request->subscriptions)){
            $errors = [
                'Subscriptions' => 'Field Subscriptions must be an array'
            ];
            return $this->validationFailed('422 unprocessible Entity', $errors);
        }

        // Gets all the Subscriptions in the array using their ids
        $subscriptions = Subscription::whereIn('id', $request->subscriptions)->get();

        /** 
         * loops through the collection and deletes the Subscriptions
         *  Tracks the number of Subscriptions that was restored as well
        */
        $subscriptions->each(function($item, $key) use (&$deactivated){
            $item->is_active = false;
            if($item->save()) $deactivated++;
        });

        // checks if any Subscription was restored
        if($deactivated > 0){
            return $this->actionSuccess("$deactivated Subscriptions deactivated");
        }else{
            return $this->notfound('Subscriptions not found');
        }   
    }
}
