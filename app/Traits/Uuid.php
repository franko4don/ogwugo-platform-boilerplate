<?php 

namespace App\Traits;
use Ramsey\Uuid\Uuid as MUuid;


trait Uuid
{

    /**
     * Boot function from laravel.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = MUuid::uuid4()->toString();
        });
    }
}