<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class Testcontroller extends Controller
{
    public function nginx(){
        $path = __DIR__.'/../../../../';
        // $path = __DIR__.'/../../../../try.conf';

        // Helper::editNginxConfig($path, ['wel.ng', 'adonis.me']);
        Helper::createNginxConfig($path, 'genn.conf', ['wel.ng', 'adonis.me']);
    }
}
