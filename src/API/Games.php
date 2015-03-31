<?php


namespace Skmetaly\TwitchApi\API;


/**
 * Class Games
 * Api documentation : https://github.com/justintv/Twitch-API/blob/master/v3_resources/games.md
 *
 * @package Skmetaly\TwitchApi\API
 */
class Games extends BaseApi
{

    /**
     *  Returns a list of games objects sorted by number of current viewers on Twitch, most popular first.
     */
    public function topGames()
    {
        $response = $this->client->get('/kraken/games/top');

        return $response->json();
    }
}