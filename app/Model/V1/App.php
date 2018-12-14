<?php

namespace App\Model\V1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;


class App extends Model
{
    use SoftDeletes;
    protected $fillable = ['uuid', 'secret', 'test_secret', 'name', 'api_url', 'app_domain'];
    
    protected $casts = [
        'id' => 'string',
        'is_active' => 'boolean'
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public static function boot()
    {
        parent::boot();

        self::creating(function ($app) {
            $app->id = Uuid::uuid4()->toString();
            $app->secret = md5(Uuid::uuid4()->toString());
            $app->test_secret = md5(Uuid::uuid4()->toString());
        });
    }


}
