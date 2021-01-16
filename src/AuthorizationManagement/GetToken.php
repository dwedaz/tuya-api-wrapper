<?php namespace Dwedaz\TuyaApiWrapper\AuthorizationManagement;

use Dwedaz\TuyaApiWrapper\Service;
//Get the access token
class GetToken extends Service{

    protected $method = 'GET';
    protected $path = 'v1.0/token';
    protected $requiredAccessToken = false;

}