<?php

namespace App\Model\V1;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use Ramsey\Uuid\Uuid;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Hash;

class OrganizationUser extends Model
{

    protected $fillable = [
            'user_id', 'email', 'organization_id', 
            'firstname', 'lastname', 'phone', 'password',
            
        ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'deleted_at', 'created_at', 'updated_at', 'reactivation_code'
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

    public function organization(){
        return $this->belongsToMany(Organization::class);
    }

    public function user(){
        return $this->belongsToMany(User::class);
    }

     /**
     * Automatically creates hash for the user password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

}
