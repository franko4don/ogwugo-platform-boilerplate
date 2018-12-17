<?php

namespace App\Model\V1;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;


class Feature extends Model
{
    use Uuid;
    use SoftDeletes;

    protected $fillable = ['name', 'app_id', 'is_active', 'updated_by', 'created_by', 'description'];
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at', 'created_at', 'updated_at'
    ];

    protected $casts = [
        'id' => 'string',
        'is_active' => 'boolean'
    ];
}
