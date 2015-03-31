<?php


namespace Skmetaly\TwitchApi\API;


/**
 * Class Subscriptions
 * Api documentation : https://github.com/justintv/Twitch-API/blob/master/v3_resources/subscriptions.md
 *
 * @package Skmetaly\TwitchApi\API
 */
class Subscriptions extends BaseApi
{

    /**
     * Returns a list of subscription objects sorted by subscription relationship creation date which contain users subscribed to :channel.
     *
     * Authenticated, required scope: channel_subscriptions
     *
     * @param      $channel
     * @param      $options
     * @param null $token
     *
     * @return json
     */
    public function channelsSubscriptions($channel, $options = [], $token = null)
    {
        $availableOptions = ['limit', 'offset', 'direction'];

        $query = [];

        $token = $this->getToken($token);

        //  Filter the available options
        foreach ($availableOptions as $option) {

            if (isset($options[ $option ])) {

                $query[ $option ] = $options[ $option ];
            }
        }

        $parameters = $this->getDefaultHeaders($token);
        $parameters[ 'query' ] = $query;

        $response = $this->client->get('/kraken/channels/' . $channel . '/subscriptions', $parameters);

        return $response->json();
    }

    /**
     * Returns a subscription object which includes the user if that user is subscribed. Requires authentication for :channel.
     *
     * Authenticated, required scope: channel_check_subscription
     *
     * @param      $channel
     * @param      $user
     * @param null $token
     *
     * @return mixed
     */
    public function channelSubscriptionsUser($channel, $user, $token = null)
    {
        $token = $this->getToken($token);
        $url = 'https://api.twitch.tv/kraken/channels/' . $channel . '/subscriptions/' . $user;

        $request = $this->createRequest('GET', $url, $token);

        $response = $this->client->send($request);

        return $response->json();
    }

    /**
     *Returns a channel object that user subscribes to. Requires authentication for :user.
     *
     * Authenticated, required scope: user_subscriptions
     *
     * @param      $user
     * @param      $channel
     * @param null $token
     *
     * @return json
     */
    public function userSubscriptionChannel($user, $channel, $token = null)
    {
        $token = $this->getToken($token);
        $url = 'https://api.twitch.tv/kraken/users/' . $user . '/subscriptions/' . $channel;

        $request = $this->createRequest('GET', $url, $token);

        $response = $this->client->send($request);

        return $response->json();
    }

}