<?php

namespace App\Model\V1;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use Ramsey\Uuid\Uuid;

class OrganizationUser extends Model
{
    protected $fillable = [
            'user_id', 'email', 'organization_id', 
            'firstname', 'lastname', 'phone', 'password',
            
        ];
    
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($orguser) {
           $orguser->verification_code = Helper::generateCode();
           $orguser->{$orguser->getKeyName()} = Uuid::uuid4()->toString();
        });
    }
}
