<?php

namespace App\Api\V1\Requests;

use Dingo\Api\Http\FormRequest;

class AssignRoleRequest extends FormRequest
{
    public function rules()
    {
        return [
            // add user check and model check
        ];
    }

    public function authorize()
    {
        return true;
    }
}
