<?php namespace Dwedaz\TuyaApiWrapper;


class TuyaApi{

    private $baseUrl = 'https://openapi.tuyaus.com';
    private static $accessToken;

    public function __construct(String $clientId, String $secret){
        $this->client = new \GuzzleHttp\Client();
        $this->clientId = $clientId;
        $this->secret = $secret;
    }
    
    public function setAccessToken($accessToken){
        self::$accessToken = $accessToken;
    }

    public function call($serviceClass, ...$arguments)
    {
       
        if (class_exists($serviceClass)) {
       
            try {
                $service = new $serviceClass($arguments);
                $service->setClientId($this->clientId);
                $service->setSecret($this->secret);
                $service->setAccessToken(self::$accessToken);
                $var = $service->__toArray();
                $req = $var;
                extract($var);
                unset($req['url']);
                unset($req['method']);
                $request =  $this->client->$method($url, $req);
                $result = json_decode($request->getBody(), true);
                if ($result['success'] === false){
                    throw new \Exception($result['msg']);
                }
                if (in_array($serviceClass,[AuthorizationManagement\GetToken::class]) && isset($result['result']['access_token'])){
                    self::$accessToken = $result['result']['access_token'];
                }

                return $result;
            } catch (GuzzleException $e) {
                // Throw exception
                throw new \Exception('Service ' . $serviceClass . ' failed because ' . $e->getMessage());
            }
        }

        // Throw exception if the Service class does not exist
        throw new \Exception('Service ' . $serviceClass . ' does not defined.');
    }
}