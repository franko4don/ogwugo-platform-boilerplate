<?php

namespace App\Api\V1\Requests;

use Dingo\Api\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'string|required',
            'title' => 'string|required',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
