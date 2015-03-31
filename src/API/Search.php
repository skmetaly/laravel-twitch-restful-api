<?php


namespace Skmetaly\TwitchApi\API;


/**
 * Class Search
 * Api documentation https://github.com/justintv/Twitch-API/blob/master/v3_resources/search.md
 *
 * @package Skmetaly\TwitchApi\API
 */
class Search extends BaseApi
{
    /**
     * Returns a list of channel objects matching the search query.
     *
     * @param $options
     *
     * @return json
     */
    public function searchChannels($options)
    {
        $availableOptions = ['query', 'limit', 'offset'];

        $parameters = [];

        //  Filter the available options
        foreach ($availableOptions as $option) {

            if (isset($options[ $option ])) {

                $parameters[ $option ] = $options[ $option ];
            }
        }

        $response = $this->client->get('/kraken/search/channels', ['query' => $parameters]);

        return $response->json();
    }

    /**
     * Returns a list of stream objects matching the search query.
     *
     * @param $options
     *
     * @return mixed
     */
    public function searchStreams($options)
    {
        $availableOptions = ['query', 'limit', 'offset', 'hls'];

        $parameters = [];

        //  Filter the available options
        foreach ($availableOptions as $option) {

            if (isset($options[ $option ])) {

                $parameters[ $option ] = $options[ $option ];
            }
        }

        $response = $this->client->get('/kraken/search/streams', ['query' => $parameters]);

        return $response->json();
    }


    /**
     * Returns a list of game objects matching the search query.
     *
     * @param $options
     *
     * @return mixed
     */
    public function searchGames($options)
    {
        $availableOptions = ['query', 'type', 'live'];

        $parameters = [];

        //  Filter the available options
        foreach ($availableOptions as $option) {

            if (isset($options[ $option ])) {

                $parameters[ $option ] = $options[ $option ];
            }
        }

        $response = $this->client->get('/kraken/search/games', ['query' => $parameters]);

        return $response->json();
    }

    /**
     * STREAMS
     */


    /**
     * Returns a stream object if live.
     *
     * @param $channel
     *
     * @return json
     */
    public function streamsChannel($channel)
    {
        $response = $this->client->get(config('twitch-api.api_url') . '/kraken/streams/' . $channel);

        return $response->json();
    }

}