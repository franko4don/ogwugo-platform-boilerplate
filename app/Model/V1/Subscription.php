<?php

namespace App\Model\V1;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['type', 'created_by', 'updated_by', 'duration', 'price'];

    
}