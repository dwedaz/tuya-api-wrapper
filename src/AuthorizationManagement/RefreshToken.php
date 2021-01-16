<?php namespace Dwedaz\TuyaApiWrapper\AuthorizationManagement;

use Dwedaz\TuyaApiWrapper\Service;
//Get the access token
class RefreshToken extends Service{

    protected $method = 'GET';
    protected $path = 'v1.0/token/%s';
    protected $requiredAccessToken = false;
    
    public function getUrl(){
        return sprintf(parent::getUrl(), $this->params);
        
    }

    public function getParams(){
        return [];
    }
}