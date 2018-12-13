<?php

namespace App\Model\V1;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;


class App extends Model
{
   
    protected $fillable = ['uuid', 'secret', 'test_secret', 'name', 'api_url', 'app_domain'];
    
    protected $casts = [
        'id' => 'string'
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

        self::creating(function ($app) {
            $app->id = Uuid::uuid4()->toString();
            $app->secret = md5(Uuid::uuid4()->toString());
            $app->test_secret = md5(Uuid::uuid4()->toString());
        });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }


}
