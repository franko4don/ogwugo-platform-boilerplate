<?php
    define('NEXMO_API_KEY', '02d16dab');
    define('NEXMO_API_SECRET', 'c9Og0J2yQdNFOM0O');
    define('TO_NUMBER', '23407037219055');
    $basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
    $client = new \Nexmo\Client($basic);

    $message = $client->message()->send([
        'to' => TO_NUMBER,
        'from' => 'Ego gi',
        'text' => 'A text message sent using the Nexmo SMS API'
    ]);