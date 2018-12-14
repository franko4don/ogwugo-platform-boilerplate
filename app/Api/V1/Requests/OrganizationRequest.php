<?php

namespace App\Api\V1\Requests;

use Dingo\Api\Http\FormRequest;

class OrganizationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'string|required',
            'domain_name' => 'unique:organizations|required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
