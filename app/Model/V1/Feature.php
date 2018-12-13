<?php

namespace App\Model\V1;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{

    protected $fillable = ['name', 'app_id', 'is_active', 'updated_by', 'created_by'];
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

}
