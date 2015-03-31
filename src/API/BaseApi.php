<?php

namespace Skmetaly\TwitchApi\API;

use GuzzleHttp\Client;
use Skmetaly\TwitchApi\Exceptions\RequestRequiresAuthenticationException;

/**
 * Class BaseApi
 * @package Skmetaly\TwitchApi\API
 */
class BaseApi
{

    /**
     * @var token
     */
    protected $token;

    /**
     * @var GuzzleClient
     */
    protected $client;

    /**
     * @param null $token
     */
    public function __construct($token = null)
    {
        if ($token) {

            $this->setToken($token);
        }

        $this->client = new Client([
            'base_url' => config('twitch-api.api_url'),
            'defaults' => [
                'headers' => ['Accept' => 'application/vnd.twitchtv[v3]+json']
            ]
        ]);
    }

    /**
     * @param $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @param null $token
     *
     * @return null
     *
     * @throws RequestRequiresAuthenticationException
     */
    public function getToken($token = null)
    {
        if ($token != null) {

            return $token;
        }

        if ($this->token == null) {

            throw new RequestRequiresAuthenticationException();
        }

        return $this->token;
    }

    /**
     * Creates an authorized request
     *
     * @param $type
     * @param $url
     * @param $token
     *
     * @return \GuzzleHttp\Message\Request|\GuzzleHttp\Message\RequestInterface
     */
    protected function createRequest($type, $url, $token)
    {
        return $this->client->createRequest($type, $url, $this->getDefaultHeaders($token));
    }

    /**
     * @param null $token
     *
     * @return array
     */
    protected function getDefaultHeaders($token = null)
    {
        $headers = [
            'headers' => [
                'Accept' => 'application/vnd.twitchtv.v3+json'
            ]
        ];

        if ($token != null) {

            $headers[ 'headers' ][ 'Authorization' ] = 'OAuth ' . $token;
        }

        return $headers;
    }
}