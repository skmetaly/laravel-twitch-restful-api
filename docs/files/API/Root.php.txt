<?php


namespace Skmetaly\TwitchApi\API;


/**
 * Class Root
 * Api documentation : https://github.com/justintv/Twitch-API/blob/master/v3_resources/root.md
 *
 * @package Skmetaly\TwitchApi\API
 */
class Root extends BaseApi
{

    /**
     * Basic information about the API and authentication status. If you are authenticated, the response includes the status of your token and links to other related resources.
     *
     * @return json
     */
    public function root()
    {
        $response = $this->client->get('/kraken');

        return $response->json();
    }
}
