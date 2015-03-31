<?php


namespace Skmetaly\TwitchApi\API;


/**
 * Class Ingests
 * Api documentation : https://github.com/justintv/Twitch-API/blob/master/v3_resources/ingests.md
 *
 * @package Skmetaly\TwitchApi\API
 */
class Ingests extends BaseApi
{

    /**
     *  Returns a list of ingest objects.
     */
    public function ingests()
    {
        $response = $this->client->get('/kraken/ingests');

        return $response->json();
    }
}