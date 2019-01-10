<?php

namespace App\Api\V1\Requests;

use Dingo\Api\Http\FormRequest;

class FeatureSubscriptionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'feature_id' => 'string|required',
            'subscription_id' => 'required|string'
         ];
    }

    public function authorize()
    {
        return true;
    }
}
