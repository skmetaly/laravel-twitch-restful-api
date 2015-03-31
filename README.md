# laravel-twitch-restful-api
Laravel Twittch restful api. An implementation of the twitch restful api V3 provided by Twitch.tv
Documentation of the API can be found at [Twitch restful api link](https://github.com/justintv/Twitch-API)

# Installation

Require the package in composer.json : 
```bash
"skmetaly/laravel-twitch-restful-api": "dev-master"
```
In ```config/app.php``` add ```providers```
```php
'Skmetaly\TwitchApi\Providers\TwitchApiServiceProvider'
```
In ```aliases```
```php
'TwitchApi'=>'Skmetaly\TwitchApi\Facades\TwitchApiServiceFacade'
```
Publish the config
```php
php artisan vendor:publish --force
```
Create a twitch application ( in your twitch settings page, Connections tab )
Create a client secret
Add both client secret, client id to the twitch-api.php config

Change the scopes that the application needs to better suit your needs

# Usage

The api provides both non-authenticated and authenticated requests

##  Authentication

Twitch api uses [OAuth 2.0 protocol] for authentication.

This API uses the Authorization Code Flow.

First step for authenticating a user is to send him to the twitch authentication URL  

 ```php
    public function authenticate()
    {
        return Redirect::to(TwitchApi::authenticationURL());
    }
 ```
 Keep in mind that the api uses the config set in twitch-api.redirect_url for redirecting after authentication
 
 After the user accepted the scopes and authorised your app, it will be redirected at the value set in config('twitch-api.redirect_url')
 
 A sample of handling the redirect :
 
  ```php
     public function redirect()
     {
         $code = Input::get('code');
 
         $token = TwitchApi::requestToken($code);
     }
  ```
   
   You need to persist both the username and token associated with it to use all of the authenticated requests
    
    
    
    
[OAuth 2.0 protocol]:http://hueniverse.com/2010/05/introducing-oauth-2-0