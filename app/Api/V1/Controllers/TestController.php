<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Twilio\Rest\Client as TwilioClient;

class Testcontroller extends Controller
{
    public function __construct(){
       $twilio_account_id   = getenv("TWILIO_SID");
       $twilio_auth_token    = getenv("TWILIO_TOKEN");

       $this->twilioClient = new TwilioClient($twilio_account_id, $twilio_auth_token);
    }

    
    public function nginx(){
        $path = __DIR__.'/../../../../';
        // Helper::editNginxConfig($path, ['wel.ng', 'adonis.me']);
        Helper::createNginxConfig($path, 'genn.conf', ['wel.ng', 'adonis.me']);
    }
}
