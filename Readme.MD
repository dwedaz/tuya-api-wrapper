
# Tuya API Wrapper for PHP

<dl>
  <dt>Reference Docs</dt><dd><a href="https://developer.tuya.com/en/docs/iot/open-api/api-reference/api-reference?">https://developer.tuya.com/en/docs/iot/open-api/api-reference/api-reference?</a></dd>
  
</dl>

Tuya opens up a variety of APIs covering business scenarios such as device pairing, smart home management, device control, and scene automation

These client libraries are not officially supported by tuya. However, the libraries are considered work and are in maintenance mode. This means that we will address critical bugs and security issues, for the feature use will add some new features.

## Installation ##

You can use **Composer** or simply **Download the Release**

### Composer

The preferred method is via [composer](https://getcomposer.org/). Follow the
[installation instructions](https://getcomposer.org/doc/00-intro.md) if you do not already have
composer installed.

Once composer is installed, execute the following command in your project root to install this library:

```sh
composer require dwedaz/tuya-api-wrapper:"1.0"
```

Finally, be sure to include the autoloader:

```php
require_once '/path/to/your-project/vendor/autoload.php';
```

# Requirements
* [PHP 7.0.0 or higher](https://www.php.net/)

### Basic Example ###

```
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
}catch (Exception $e){
    echo $e->getMessage();
}

```
