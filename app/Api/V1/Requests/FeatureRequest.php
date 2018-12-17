<?php

namespace App\Api\V1\Requests;

use Dingo\Api\Http\FormRequest;

class FeatureRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'string|required',
            'description' => 'required|string'
         ];
    }

    public function authorize()
    {
        return true;
    }
}
