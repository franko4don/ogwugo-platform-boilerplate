<?php

namespace App\Model\V1;
use Ramsey\Uuid\Uuid;


use Illuminate\Database\Eloquent\Model;

class App extends Model
{

    protected $fillable = ['uuid', 'secret', 'test_secret', 'name', 'api_url', 'app_domain'];
    

    public static function boot()
    {
        parent::boot();

        self::creating(function ($app) {
            $app->uuid = Uuid::uuid4()->toString();
            $app->secret = md5(Uuid::uuid4()->toString());
            $app->test_secret = md5(Uuid::uuid4()->toString());
        });
    }

    

}
