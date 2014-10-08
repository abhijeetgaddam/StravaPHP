<?php
namespace Strava\API;

use \League\OAuth2\Client\Token\AccessToken as AccessToken;

class OAuth extends \League\OAuth2\Client\Provider\AbstractProvider
{

    public function __construct($options)
    {
        parent::__construct($options);
        $this->headers = array(
            'Authorization' => 'Bearer'
        );
    }
    
    public function urlAuthorize()
    {
        return 'https://www.strava.com/oauth/authorize';
    }

    public function urlAccessToken()
    {
        return 'https://www.strava.com/oauth/token';
    }

    public function urlUserDetails(AccessToken $token)
    {
        return 'https://www.strava.com/api/v3/athlete/?access_token='.$token;
    }

    public function userDetails($response, AccessToken $token) {}

    public function userUid($response, AccessToken $token) 
    {
        return $response->id;
    }
    
    public function userEmail($response, AccessToken $token)
    {
        return isset($response->email) && $response->email ? $response->email : null;
    }
    
    public function userScreenName($response, AccessToken $token)
    {
        return array($response->firstname, $response->lastname);
    }

}