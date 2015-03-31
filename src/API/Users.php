<?php


namespace Skmetaly\TwitchApi\API;


/**
 * Class Users
 * API Documentation : https://github.com/justintv/Twitch-API/blob/master/v3_resources/users.md
 *
 * @package Skmetaly\TwitchApi\API
 */
class Users extends BaseApi
{

    /**
     * Returns a user object.
     *
     * @param $username
     *
     * @return json
     */
    public function user($username)
    {
        $user = $this->client->get('https://api.twitch.tv/kraken/users/' . $username);

        return $user->json();
    }

    /**
     * Returns a user object.
     *
     * Authenticated, required scope: user_read
     *
     * @param null $token
     *
     * @return json
     */
    public function authenticatedUser($token = null)
    {
        $token = $this->getToken($token);

        $user = $this->client->get('https://api.twitch.tv/kraken/user?oauth_token=' . $token);

        return $user->json();
    }

    /**
     * Returns a list of stream objects that the authenticated user is following.
     *
     * Authenticated, required scope: user_read
     *
     * @param null $token
     *
     * @return json
     * @throws \Skmetaly\TwitchApi\Exceptions\RequestRequiresAuthenticationException
     */
    public function streamsFollowed($token = null)
    {
        $token = $this->getToken($token);

        $streams = $this->client->get('https://api.twitch.tv/kraken/streams/followed?oauth_token=' . $token);

        return $streams->json();
    }

    /**
     * Returns a list of video objects from channels that the authenticated user is following.
     *
     * Authenticated, required scope: user_read
     *
     * @param null $token
     *
     * @return json
     * @throws \Skmetaly\TwitchApi\Exceptions\RequestRequiresAuthenticationException
     */
    public function videosFollowed($token = null)
    {
        $token = $this->getToken($token);

        $videos = $this->client->get('https://api.twitch.tv/kraken/videos/followed?oauth_token=' . $token);

        return $videos->json();
    }
}