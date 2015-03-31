<?php

namespace Skmetaly\TwitchApi\API;

use GuzzleHttp\Client;


/**
 * Class Authentication
 * API Documentation : https://github.com/justintv/Twitch-API/blob/master/v3_resources/teams.md
 *
 * @package Skmetaly\TwitchApi\API
 */
class Teams extends BaseApi
{

    /**
     * Returns a list of active teams.
     *
     * @return mixed
     */
    public function teams()
    {
        $response = $this->client->get('/kraken/teams');

        return $response->json();
    }

    /**
     * Returns a team object for :team.
     *
     * @param $team
     *
     * @return mixed
     */
    public function team($team)
    {
        $response = $this->client->get('/kraken/teams/' . $team);

        return $response->json();

    }
}