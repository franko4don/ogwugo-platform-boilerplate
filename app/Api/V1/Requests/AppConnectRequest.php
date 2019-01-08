<?php

namespace App\Api\V1\Requests;

use Dingo\Api\Http\FormRequest;

class AppConnectRequest extends FormRequest
{
    public function rules()
    {
        /**
         * recheck this validation someday incase someone wants to 
         * enter an app url that already exists
        */
        return [
            'app_id' => 'string|required',
            'custom_subdomain' => 'required'//|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
