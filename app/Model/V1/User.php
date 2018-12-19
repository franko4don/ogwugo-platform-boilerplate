<?php

namespace App\Model\V1;

use Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Helpers\Helper;
use Ramsey\Uuid\Uuid;


class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'email', 'password', 'lastname', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'deleted_at', 'created_at', 'updated_at', 'reactivation_code'
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

        self::creating(function ($model) {
            if (!$model->password) {
                $model->password = '.';
            }
            $model->verification_code = Helper::generateCode();
            $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
        });
    }

    /**
     * Establishes a one to many relationship with organization table
     */
    public function organization()
    {
        return $this->hasMany(Organization::class);
    }

    /**
     * Establishes a one to many relationship with organization table
     */
    public function currentOrganizationUser($organization)
    {
        return $this->hasMany(OrganizationUser::class)
                    ->where('organization_id', $organization->id)
                    ->first();
    }

    /**
     * Establishes a one to many relationship with feature table
     */
    public function feature()
    {
        return $this->hasMany(Feature::class);
    }

    /**
     * Establishes a one to many relationship with feature table
     */
    public function featureCreatedBy()
    {
        return $this->hasMany(Feature::class, 'created_by', 'id');
    }

    /**
     * Establishes a one to many relationship with feature table
     */
    public function featureUpdatedBy()
    {
        return $this->hasMany(Feature::class, 'updated_by', 'id');
    }

    /**
     * Establishes a one to many relationship with feature table
     */
    public function featureActivatedBy()
    {
        return $this->hasMany(Feature::class, 'activated_by', 'id');
    }

     /**
     * Establishes a one to many relationship with feature table
     */
    public function subscriptionCreatedBy()
    {
        return $this->hasMany(Subscription::class, 'created_by', 'id');
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

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
