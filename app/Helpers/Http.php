<?php
namespace App\Http\Helpers;

use \GuzzleHttp\Client;
use Exception;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

/*
|--------------------------------------------------------------------------
| Custom Http Client
|--------------------------------------------------------------------------
|
| A customized Http Client Class that enables user make api calls to 
| remote urls from within an app using Guzzle
|
*/

class Http
{

    private static $client;
    private static $response;

    public static function client()
    {
        if (!self::$client)
        self::$client = new Client;
        return self::$client;
    }

    /**
     * Processes response returned by guzzle
     * @param mixed $response
     * @param boolean $toArray
     */
    private static function processResponse(ResponseInterface $response, $toArray = true)
    {
        return json_decode(self::$response->getBody(), $toArray);
    }

    /**
    * Sends a get request to defined url
    * @param string $url 
    * @param array $params
    * @return mixed
    */
   public static function get($url = '', $params = [], $responseToArray = true)
   {
        self::$response = self::client()->request('GET', $url, $params);
        
        return self::processResponse(self::$response, $responseToArray);
    }

   /**
    * Sends a post request to defined url
    * @param string $url 
    * @param array $params
    * @return mixed
    */
   public static function post($url = '', $params = [], $responseToArray = true)
   {
       self::$response = self::client()->request('POST', $url, $params);
       return self::processResponse(self::$response, $responseToArray);
   }

   

    /**
    * Sends a delete request to defined url
    * @param string $url 
    * @param array $params
    * @return mixed
    */
    public static function delete($url = '', $params = [], $responseToArray = true)
    {
        self::$response = self::client()->request('DELETE', $url, $params);
        return self::processResponse(self::$response, $responseToArray);
    }

    /**
     * Sends a put request to defined url
    * @param string $method
    * @param string $url 
    * @param array $params
    * @return mixed
    */
    public static function put($url = '', $params = [], $responseToArray = true)
    {
        self::$response = self::client()->request('PUT', $url, $params);
        return self::processResponse(self::$response, $responseToArray);
    }


}
