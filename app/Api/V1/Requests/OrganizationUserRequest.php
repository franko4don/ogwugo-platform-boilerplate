<?php

namespace App\Api\V1\Requests;

use Dingo\Api\Http\FormRequest;

class OrganizationUserRequest extends FormRequest
{
    
    public function rules()
    {
        return [
            'firstname' => 'nullable|string',
            'lastname' => 'nullable|string',
            'phone' => 'nullable|numeric',
            'email' => 'email|required',
            'password' => 'string|required'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
