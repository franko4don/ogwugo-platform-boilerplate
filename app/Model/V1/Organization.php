<?php

namespace App\Model\V1;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = ['name', 'motto', 'logo', 'email', 'domain_name', 'user_id'];

}
