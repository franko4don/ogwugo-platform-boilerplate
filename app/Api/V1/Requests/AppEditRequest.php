<?php

namespace App\Api\V1\Requests;

use Dingo\Api\Http\FormRequest;

class AppEditRequest extends FormRequest
{
    public function rules()
    {
        /**
         * recheck this validation someday incase someone wants to 
         * enter an app url that already exists
        */
        return [
            'name' => 'string|required',
            'api_url' => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
