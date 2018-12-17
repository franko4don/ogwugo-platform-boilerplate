<?php

namespace App\Api\V1\Requests;

use Dingo\Api\Http\FormRequest;

class SubscriptionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'string|required',
            'description' => 'required|string',
            'duration' => 'numeric|required',
            'price' => 'numeric|required'
         ];
    }

    public function authorize()
    {
        return true;
    }
}
