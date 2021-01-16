<?php

require 'vendor/autoload.php';
use Dwedaz\TuyaApiWrapper\TuyaApi;

use Dwedaz\TuyaApiWrapper\AuthorizationManagement\GetToken;
use Dwedaz\TuyaApiWrapper\AuthorizationManagement\RefreshToken;
use Dwedaz\TuyaApiWrapper\DeviceControl\ControlDevice;
use Dwedaz\TuyaApiWrapper\DeviceControl\DeviceStatus;

$clientId = 'xxxxxxxxxxxxx';
$secret = 'xxxxxxxxxxxxx';
$deviceId = 'xxxxxxxxx';
$filename = 'token.json';

try{

    $client = new TuyaApi($clientId, $secret);
    if (!file_exists($filename)){
        $accessToken = json_decode(file_get_contents($filename), true);
        $token = $accessToken['result']['access_token'];
        $client->setAccessToken($token);
    }else{
        $accessToken = $client->call(GetToken::class, ['grant_type' => 1]); 
        file_put_contents($filename, json_encode($accessToken));
    }

  
    print_r($client->call(DeviceStatus::class, $deviceId));

    //print_r($client->call(ControlDevice::class, $deviceId, [['code'=>"switch_led", "value"=> true]]));
    
}catch (Exception $e){
    echo $e->getMessage();
}