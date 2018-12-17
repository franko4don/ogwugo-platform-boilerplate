<?php

namespace App\Model\V1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class Subscription extends Model
{
    use Uuid;
    use SoftDeletes;

    protected $fillable = ['name', 'created_by', 'updated_by', 'duration', 'price', 'description'];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $casts = [
        'id' => 'string',
        'is_active' => 'boolean',
        'duration' => 'int',
        'price' => 'double'
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

}
