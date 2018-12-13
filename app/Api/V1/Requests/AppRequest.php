<?php

namespace App\Api\V1\Requests;

use Dingo\Api\Http\FormRequest;

class AppRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'string|required',
            'api_url' => 'unique:apps|required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
