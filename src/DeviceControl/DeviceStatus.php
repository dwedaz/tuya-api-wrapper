<?php namespace Dwedaz\TuyaApiWrapper\DeviceControl;

use Dwedaz\TuyaApiWrapper\Service;

//Get the access token
class DeviceStatus extends Service{
    protected $method = 'GET';
    protected $path = 'v1.0/devices/%s/status';
    private $deviceId = '';

    public function __construct($params){
        $this->deviceId = $params[0];
        parent::__construct($params);
    }

    public function getUrl(){
        return sprintf(parent::getUrl(), $this->deviceId);
    }

    public function getParams(){
        return [];
    }
    
}