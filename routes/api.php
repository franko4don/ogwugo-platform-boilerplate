<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {
    $api->group(['prefix' => 'v1/auth'], function(Router $api) {
        $api->post('signup', 'App\\Api\\V1\\Controllers\\Authy\\SignUpController@signUp');
        $api->post('login', 'App\\Api\\V1\\Controllers\\Authy\\LoginController@login');

        $api->post('recovery', 'App\\Api\\V1\\Controllers\\Authy\\ForgotPasswordController@sendResetEmail');
        $api->post('reset', 'App\\Api\\V1\\Controllers\\Authy\\ResetPasswordController@resetPassword');

        $api->post('logout', 'App\\Api\\V1\\Controllers\\Authy\\LogoutController@logout');
        $api->post('refresh', 'App\\Api\\V1\\Controllers\\Authy\\RefreshController@refresh');
        $api->get('me', 'App\\Api\\V1\\Controllers\\UserController@me');
    });
    $api->group(['prefix' => 'v1'], function(Router $api) {
        $api->get('test', 'App\\Api\\V1\\Controllers\\TestController@nginx');

        $api->get('subscriptions', 'App\\Api\\V1\\Controllers\\SubscriptionController@subscription');
        $api->get('subscription/{id}', 'App\\Api\\V1\\Controllers\\SubscriptionController@subscription');
        $api->post('subscription/create', 'App\\Api\\V1\\Controllers\\SubscriptionController@create');
        $api->patch('subscription/edit/{id}', 'App\\Api\\V1\\Controllers\\SubscriptionController@edit');
        $api->delete('subscription/delete/{id}', 'App\\Api\\V1\\Controllers\\SubscriptionController@delete');
        

        $api->get('apps', 'App\\Api\\V1\\Controllers\\AppController@app');
        $api->get('app/{id}', 'App\\Api\\V1\\Controllers\\AppController@getSingleApp');
        $api->post('app/create', 'App\\Api\\V1\\Controllers\\AppController@create');
        $api->patch('app/edit/{id}', 'App\\Api\\V1\\Controllers\\AppController@edit');
        $api->delete('app/delete/{id}', 'App\\Api\\V1\\Controllers\\AppController@delete');
        

        $api->group(['middleware' => 'jwt.auth'], function(Router $api) {
            $api->get('protected', function() {
                return response()->json([
                    'message' => 'Access to protected resources granted! You are seeing this text as you provided the token correctly.'
                ]);
            });

            $api->get('refresh', [
                'middleware' => 'jwt.refresh',
                function() {
                    return response()->json([
                        'message' => 'By accessing this endpoint, you can refresh your access token at each request. Check out this response headers!'
                    ]);
                }
            ]);
        });

        $api->get('hello', function() {
            return response()->json([
                'message' => 'This is a simple example of item returned by your APIs. Everyone can see it.'
            ]);
        });
        
    });
});
