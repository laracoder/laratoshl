<?php
namespace Laratoshl;

use Exception;
use GuzzleHttp\Client;

/**
 * Class Toshl API
 * Empowers you to get Data from TOSHL API v2.
 * @link https://developer.toshl.com/docs/ | TOSHL API Documentation
 * @package Laratoshl
 * @author Daniel Schmelz
 */
class ToshlAPI
{

    /**
     * Valid Endpoints for TOSHL API
     * @var array
     */
    private $validEndpoints = [
        'accounts', 
        'budgets', 
        'categories',
        'categories/sums',
        'currencies', 
        'entries', 
        'exports', 
        'images', 
        'me', 
        'reports', 
        'tags'       
    ];

    /**
     * Guzzle HTTP Client Object
     * @var Client|null
     */
    private $guzzleClient = null;

    /**
     * TOSHL APP TOKEN
     * Has to be generated before usage in TOSHL Developer Area
     * @var string
     */
    public $token = '';
    
    /**
     * ToshlApi constructor.
     * @param string $token
     */
    public function __construct($token = '')
    {
        // Instantiate a new Guzzle HTTP Client
        $this->guzzleClient = new Client([
            'base_uri' => config('laratoshl.base_uri'),
            'timeout'  => config('laratoshl.timeout'),
            'verify' => false,   // Important to set this to false if you are on windows env
            'headers' => [
                'User-Agent' => 'laratoshl/1.0',
                'Accept-Language' => config('laratoshl.language'),
                'Accept'     => 'application/json',
            ],
        ]);

        // Set the token
        if($token != '') {
            $this->token = $token;
        }
    }

    /**
     * Send a Request to an API Endpoint
     * @param $endpoint string
     * @param array $optional
     * @return mixed
     * @throws Exception
     */
    public function sendGetRequestToAPI($endpoint = '', $optional = [])
    {
        if(in_array($endpoint, $this->validEndpoints)) {
            $res = $this->guzzleClient->get($endpoint, [
                'auth' => [$this->token, null],
            ]+ $optional);

            $body = json_decode($res->getBody()->getContents());
            return $body;
        } else {
            throw new Exception('No valid Endpoint triggered. You tried to reach: "'.$endpoint.'"". Valid Endpoints: ' . implode(',',$this->validEndpoints));
        }
    }

    /**
     * Set the TOSHL token before accessing an endpoint.
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

}

