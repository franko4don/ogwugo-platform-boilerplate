<?php

namespace App\Model\V1;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'motto', 'logo', 
        'email', 'domain_name', 'user_id'
    ];
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $casts = [
        'id' => 'string',
        'is_active' => 'boolean'
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'user_id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * Boot function from laravel.
     */
    protected static function boot()
    {
        parent::boot();

        self::addGlobalScope('organizations', function($builder) {
            $builder->with('user');
        });

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
        });
    }

    /**
     * Establishes relationship between organization and user table
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Establishes relationship between organization and user table
     */
    public function organizationUser()
    {
        return $this->hasMany(OrganizationUser::class);
    }

    /**
     * Establishes relationship between organization and app table
     */
    public function apps()
    {
        return $this->belongsToMany(App::class);
    }

    /**
     * Establishes relationship between organization and app table
     */
    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

}
