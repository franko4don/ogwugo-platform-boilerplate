<?php

namespace App\Model\V1;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [ 'name', 'country_id'];
}
