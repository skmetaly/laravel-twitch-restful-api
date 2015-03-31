<?php
namespace Skmetaly\TwitchApi\Services;

use GuzzleHttp\Exception\ClientException;
use Skmetaly\TwitchApi\API\Authentication;
use Skmetaly\TwitchApi\API\BaseApi;
use Skmetaly\TwitchApi\API\Blocks;
use Skmetaly\TwitchApi\API\Channels;
use Skmetaly\TwitchApi\API\Chat;
use Skmetaly\TwitchApi\API\Follow;
use Skmetaly\TwitchApi\API\Games;
use Skmetaly\TwitchApi\API\Ingests;
use Skmetaly\TwitchApi\API\Root;
use Skmetaly\TwitchApi\API\Search;
use Skmetaly\TwitchApi\API\Streams;
use Skmetaly\TwitchApi\API\Subscriptions;
use Skmetaly\TwitchApi\API\Teams;
use Skmetaly\TwitchApi\API\Users;
use Skmetaly\TwitchApi\API\Videos;

/**
 * Class TwitchApiService
 * @package Skmetaly\TwitchApi\Services
 */
class TwitchApiService extends BaseApi
{

    /*
     * AUTHENTICATION
     */

    /**
     * @return string
     */
    public function authenticationURL()
    {
        $authenticationAPI = new Authentication();

        return $authenticationAPI->authenticationURL();
    }

    /**
     * @param $code
     *
     * @return mixed
     * @throws \Exception
     */
    public function requestToken($code)
    {
        $authenticationAPI = new Authentication();

        return $authenticationAPI->requestToken($code);
    }

    /**
     * BLOCKS
     */

    /**
     * Returns a list of blocks objects on :login's block list. List sorted by recency, newest first.
     * Authenticated, required scope: user_blocks_read
     *
     * @param      $login
     *
     * @param null $token
     *
     * @return json
     */
    public function blocks($login, $token = null)
    {
        $token = $this->getToken($token);

        $blocksApi = new Blocks($token);

        return $blocksApi->blocks($login);
    }

    /**
     * Adds :target to :user's block list. :user is the authenticated user and :target is user to be blocked. Returns a blocks object.
     * Authenticated, required scope: user_blocks_edit
     *
     * @param      $user
     * @param      $target
     * @param null $token
     *
     * @return json
     */
    public function putBlock($user, $target, $token = null)
    {
        $token = $this->getToken($token);

        $blocksApi = new Blocks($token);

        return $blocksApi->putBlock($user, $target);
    }

    /**
     * Removes :target from :user's block list. :user is the authenticated user and :target is user to be unblocked.
     * Authenticated, required scope: user_blocks_edit
     *
     * @param      $user
     * @param      $target
     * @param null $token
     *
     * @return mixed
     */
    public function deleteBlock($user, $target, $token = null)
    {
        $token = $this->getToken($token);

        $blocksApi = new Blocks($token);

        return $blocksApi->deleteBlock($user, $target);
    }
    /*
     * USERS
     */

    /**
     * @param $username
     *
     * @return json
     */
    public function user($username)
    {
        $usersAPI = new Users();

        return $usersAPI->user($username);
    }

    /**
     * @param null $token
     *
     * @return json
     */
    public function authenticatedUser($token = null)
    {
        $token = $this->getToken($token);

        $usersAPI = new Users($token);

        return $usersAPI->authenticatedUser();
    }

    /**
     * @param null $token
     *
     * @return mixed
     * @throws \Skmetaly\TwitchApi\Exceptions\RequestRequiresAuthenticationException
     */
    public function streamsFollowed($token = null)
    {
        $token = $this->getToken($token);

        $usersAPI = new Users($token);

        return $usersAPI->streamsFollowed();
    }

    /**
     * @param null $token
     *
     * @return mixed
     * @throws \Skmetaly\TwitchApi\Exceptions\RequestRequiresAuthenticationException
     */
    public function videosFollowed($token = null)
    {
        $token = $this->getToken($token);

        $usersAPI = new Users($token);

        return $usersAPI->videosFollowed();
    }

    /**
     * CHANNELS
     */

    /**
     * Returns a channel object.
     *
     * @param $channel
     *
     * @return mixed
     */
    public function channel($channel)
    {
        $channelAPI = new Channels();

        return $channelAPI->channel($channel);
    }

    /**
     * Returns a channel object of authenticated user. Channel object includes stream key.
     *
     * Authenticated, required scope: channel_read
     *
     * @param null $token
     *
     * @return mixed
     * @throws \Skmetaly\TwitchApi\Exceptions\RequestRequiresAuthenticationException
     */
    public function authenticatedChannel($token = null)
    {
        $token = $this->getToken($token);

        $channelAPI = new Channels($token);

        return $channelAPI->authenticatedChannel();
    }

    /**
     * Update channel's status or game.
     * Authenticated, required scope: channel_editor
     *
     * Name    Required?    Type    Description
     * status    optional    string    Channel's title.
     * game    optional    string    Game category to be classified as.
     * delay    optional    string    Channel delay in seconds. Requires the channel owner's OAuth token.
     *
     * @param      $channel
     * @param      $options
     * @param null $token
     *
     * @return json
     * @throws ClientException
     */
    public function putChannel($channel, $options, $token = null)
    {
        $token = $this->getToken($token);

        $channelAPI = new Channels($token);

        return $channelAPI->putChannel($channel, $options);
    }

    /**
     * Resets channel's stream key.
     * Authenticated, required scope: channel_stream
     *
     * @param      $channel
     * @param null $token
     *
     * @return json
     */
    public function deleteStreamKey($channel, $token = null)
    {
        $token = $this->getToken($token);

        $channelAPI = new Channels($token);

        return $channelAPI->deleteStreamKey($channel);
    }

    /**
     * Start commercial on channel.
     * Authenticated, required scope: channel_commercial
     *
     * @param      $channel
     * @param int  $length
     * @param null $token
     */
    public function postCommercial($channel, $length = 30, $token = null)
    {
        $token = $this->getToken($token);

        $channelAPI = new Channels($token);

        return $channelAPI->postCommercial($channel, $length);
    }

    /**
     * CHAT
     */

    /**
     * Returns a list of all emoticon objects for Twitch.
     *
     * @param $channel
     *
     * @return json
     */
    public function chatChannel($channel)
    {
        $chatAPI = new Chat();

        return $chatAPI->chatChannel($channel);
    }

    /**
     *
     * @param $channel
     *
     * @return json
     */
    public function chatBadges($channel)
    {
        $chatAPI = new Chat();

        return $chatAPI->chatBadges($channel);
    }

    /**
     *  Returns a links object to all other chat endpoints.
     */
    public function chatEmoticons()
    {
        $chatAPI = new Chat();

        return $chatAPI->chatEmoticons();
    }


    /**
     * Returns a list of follow objects.
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
        $followAPI = new Follow();

        return $followAPI->channelFollows($channel, $options);
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
        $followAPI = new Follow();

        return $followAPI->userFollowsChannels($user, $options);
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
        $followAPI = new Follow();

        return $followAPI->userFollowsChannel($user, $channel);
    }

    public function authenticatedUserFollowsChannel($user, $channel, $options = null, $token = null)
    {
        $token = $this->getToken($token);

        $followAPI = new Follow($token);

        return $followAPI->authenticatedUserFollowsChannel($user, $channel, $options);
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

        $followAPI = new Follow($token);

        return $followAPI->authenticatedUserUnfollowsChannel($user, $channel);
    }

    /**
     * GAMES
     */

    /**
     *  Returns a list of games objects sorted by number of current viewers on Twitch, most popular first.
     */
    public function topGames()
    {
        $gamesAPI = new Games();

        return $gamesAPI->topGames();
    }

    /*
     * INGESTS
     */

    /**
     *  Returns a list of ingest objects.
     */
    public function ingests()
    {
        $ingestsApi = new Ingests();

        return $ingestsApi->ingests();
    }

    /*
     * ROOT
     */

    public function root()
    {
        $rootApi = new Root();

        return $rootApi->root();
    }

    /**
     * SEARCH
     */

    /**
     * Returns a list of channel objects matching the search query.
     *
     * @param $options
     *
     * @return json
     */
    public function searchChannels($options)
    {
        $searchApi = new Search();

        return $searchApi->searchChannels($options);
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
        $searchApi = new Search();

        return $searchApi->searchStreams($options);
    }

    /**
     * Search Games
     *
     * @param $options
     *
     * @return mixed
     */
    public function searchGames($options)
    {
        $searchApi = new Search();

        return $searchApi->searchGames($options);
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
        $streamsAPI = new Streams();

        return $streamsAPI->streamsChannel($channel);
    }

    public function streams($options)
    {
        $streamsAPI = new Streams();

        return $streamsAPI->streams($options);
    }

    public function streamsFeatured($options = [])
    {
        $streamsAPI = new Streams();

        return $streamsAPI->streamsFeatured($options);
    }

    /**
     * Returns a summary of current streams.
     *
     * @param $options
     *
     * @return mixed
     */
    public function streamsSummary($options = [])
    {
        $streamsAPI = new Streams();

        return $streamsAPI->streamsSummary($options);
    }

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
        $token = $this->getToken($token);

        $subscriptionsAPI = new Subscriptions($token);

        return $subscriptionsAPI->channelsSubscriptions($channel, $options);
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

        $subscriptionsAPI = new Subscriptions($token);

        return $subscriptionsAPI->channelSubscriptionsUser($channel, $user);
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

        $subscriptionsAPI = new Subscriptions($token);

        return $subscriptionsAPI->userSubscriptionChannel($user, $channel);
    }

    /**
     * TEAMS
     */
    public function teams()
    {
        $teamsAPI = new Teams();

        return $teamsAPI->teams();
    }

    public function team($team)
    {
        $teamsAPI = new Teams();

        return $teamsAPI->team($team);
    }

    /**
     *
     * Returns a video object.
     *
     * @param $id
     *
     * @return mixed
     */
    public function video($id)
    {
        $videosApi = new Videos();

        return $videosApi->video($id);
    }

    /**
     * Returns a list of videos created in a given time period sorted by number of views, most popular first.
     *
     * @param array $options
     *
     * @return mixed
     */
    public function videosTop($options = [])
    {
        $videosApi = new Videos();

        return $videosApi->videosTop($options);
    }

    /**
     * Returns a list of videos ordered by time of creation, starting with the most recent from :channel.
     *
     * @param $channel
     *
     * @param $options
     *
     * @return json
     */
    public function channelsVideo($channel, $options = null)
    {
        $videosApi = new Videos();

        return $videosApi->channelsVideo($channel, $options);
    }
}