<?php


namespace Skmetaly\TwitchApi\API;

use GuzzleHttp\Client;


/**
 * Class Authentication
 * API Documentation : https://github.com/justintv/Twitch-API/blob/master/v3_resources/follows.md
 *
 * @package Skmetaly\TwitchApi\API
 */
class Follow extends BaseApi
{

    /**
     * Returns a list of follow objects.
     *
     * Name    Required?    Type    Description
     * limit    optional    integer    Maximum number of objects in array. Default is 25. Maximum is 100.
     * offset    optional    integer    Object offset for pagination. Default is 0.
     * direction    optional    string    Creation date sorting direction. Default is desc. Valid values are asc and desc.
     *
     * @param $channel
     * @param $options
     *
     * @return json
     */
    public function channelFollows($channel, $options = [])
    {
        $availableOptions = ['limit', 'offset', 'direction'];

        //  Filter the available options
        foreach ($availableOptions as $option) {

            if (isset($options[ $option ])) {

                $options[ $option ] = $options[ $option ];
            }
        }

        $url = 'https://api.twitch.tv/kraken/channels/' . $channel . '/follows';

        $response = $this->client->get($url, ['body' => $options]);

        return $response->json();
    }

    /**
     * Returns a list of follows objects.
     * Parameters
     * Name    Required?    Type    Description
     * limit    optional    integer    Maximum number of objects in array. Default is 25. Maximum is 100.
     * offset    optional    integer    Object offset for pagination. Default is 0.
     * direction    optional    string    Sorting direction. Default is desc. Valid values are asc and desc.
     * sortby    optional    string    Sort key. Default is created_at. Valid values are created_at and last_broadcast.
     *
     * @param       $user
     * @param array $options
     *
     * @return mixed
     */
    public function userFollowsChannels($user, $options = [])
    {
        $availableOptions = ['limit', 'offset', 'direction', 'sortby'];

        //  Filter the available options
        foreach ($availableOptions as $option) {

            if (isset($options[ $option ])) {

                $options[ $option ] = $options[ $option ];
            }
        }

        $url = 'kraken/users/' . $user . '/follows/channels';

        $response = $this->client->get($url, ['body' => $options]);

        return $response->json();
    }

    /**
     * Returns 404 Not Found if :user is not following :target. Returns a follow object otherwise.
     *
     * @param $user
     * @param $channel
     *
     * @return mixed
     */
    public function userFollowsChannel($user, $channel)
    {
        $response = $this->client->get('kraken/users/' . $user . '/follows/channels/' . $channel);

        return $response->json();
    }

    public function authenticatedUserFollowsChannel($user, $channel, $options = null, $token = null)
    {
        $token = $this->getToken($token);

        $url = 'https://api.twitch.tv/kraken/users/' . $user . '/follows/channels/' . $channel;

        $availableOptions = ['notifications'];

        $channelOptions = [];

        //  Filter the available options
        foreach ($availableOptions as $option) {

            if (isset($options[ $option ])) {

                $channelOptions[ $option ] = $options[ $option ];
            }
        }

        //  Get the default headers that are for all requests
        $params = $this->getDefaultHeaders($token);

        //  We send data through json
        $params[ 'headers' ][ 'Content-type' ] = ['application/json'];

        //  Data
        $params[ 'body' ] = $channelOptions;

        $client = new Client();

        $request = $client->createRequest('PUT', $url, $params);

        $response = $client->send($request);

        return $response->json();
    }

    /**
     * Removes :user from :target's followers. :user is the authenticated user's name and :target is the name of the channel to be unfollowed.
     *
     * Authenticated, required scope: user_follows_edit
     *
     * @param      $user
     * @param      $channel
     * @param null $token
     *
     * @return boolean
     */
    public function authenticatedUserUnfollowsChannel($user, $channel, $token = null)
    {
        $token = $this->getToken($token);

        $request = $this->createRequest('DELETE',
            config('twitch-api.api_url') . '/kraken/users/' . $user . '/follows/channels/' . $channel, $token);

        $response = $this->client->send($request);

        if ($response->getStatusCode() == 204) {

            return true;
        }

        return false;
    }
}