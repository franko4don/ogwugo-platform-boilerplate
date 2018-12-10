<?php

namespace App\Model\V1;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class OrganizationUser extends Model
{
    protected $fillable = [
            'user_id', 'email', 'organization_id', 
            'firstname', 'lastname', 'phone', 'password',
            
        ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($orguser) {
           $orguser->verification_code = Helper::generateCode();
        });
    }
}
