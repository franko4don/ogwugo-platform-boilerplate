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

        // app api routes
        $api->get('apps', 'App\\Api\\V1\\Controllers\\AppController@getApps');
        $api->get('app/{id}', 'App\\Api\\V1\\Controllers\\AppController@getSingleApp');
        $api->post('app/create', 'App\\Api\\V1\\Controllers\\AppController@create');
        $api->patch('app/edit/{id}', 'App\\Api\\V1\\Controllers\\AppController@edit');
        $api->delete('app/delete/{id}', 'App\\Api\\V1\\Controllers\\AppController@delete');
        $api->delete('apps/delete', 'App\\Api\\V1\\Controllers\\AppController@batchDelete');
        $api->patch('app/restore/{id}', 'App\\Api\\V1\\Controllers\\AppController@restore');
        $api->patch('apps/restore', 'App\\Api\\V1\\Controllers\\AppController@batchRestore');
        $api->patch('app/activate/{id}', 'App\\Api\\V1\\Controllers\\AppController@activate');
        $api->patch('app/deactivate/{id}', 'App\\Api\\V1\\Controllers\\AppController@deactivate');
        $api->patch('apps/activate', 'App\\Api\\V1\\Controllers\\AppController@batchActivate');
        $api->patch('apps/deactivate', 'App\\Api\\V1\\Controllers\\AppController@batchDeactivate');
        
        // organization api routes
        $api->get('organizations', 'App\\Api\\V1\\Controllers\\OrganizationController@getOrganizations');
        $api->get('organization/{id}', 'App\\Api\\V1\\Controllers\\OrganizationController@getSingleOrganization');
        $api->post('organization/create', 'App\\Api\\V1\\Controllers\\OrganizationController@create');
        $api->patch('organization/edit/{id}', 'App\\Api\\V1\\Controllers\\OrganizationController@edit');
        $api->delete('organization/delete/{id}', 'App\\Api\\V1\\Controllers\\OrganizationController@delete');
        $api->delete('organizations/delete', 'App\\Api\\V1\\Controllers\\OrganizationController@batchDelete');
        $api->patch('organization/restore/{id}', 'App\\Api\\V1\\Controllers\\OrganizationController@restore');
        $api->patch('organizations/restore', 'App\\Api\\V1\\Controllers\\OrganizationController@batchRestore');
        $api->patch('organization/activate/{id}', 'App\\Api\\V1\\Controllers\\OrganizationController@activate');
        $api->patch('organization/deactivate/{id}', 'App\\Api\\V1\\Controllers\\OrganizationController@deactivate');
        $api->patch('organizations/activate', 'App\\Api\\V1\\Controllers\\OrganizationController@batchActivate');
        $api->patch('organizations/deactivate', 'App\\Api\\V1\\Controllers\\OrganizationController@batchDeactivate');
        


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
