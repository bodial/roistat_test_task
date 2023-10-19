<?php

use AmoCRM\Client\AmoCRMApiClient;
use League\OAuth2\Client\Token\AccessToken;

include_once '../vendor/autoload.php';
$config = include_once '../config/amocrmConfig.php';

$apiClient = new AmoCRMApiClient(
    $config['CLIENT_ID'],
    $config['CLIENT_SECRET'],
    $config['CLIENT_REDIRECT_URL']
);
$apiClient->setAccountBaseDomain($config['ACCOUNT_DOMAIN']);

$rawToken = json_decode(file_get_contents('../token.json'), 1);
$token = new AccessToken($rawToken);

$newToken =$apiClient->getOAuthClient()->getAccessTokenByRefreshToken($token);


file_put_contents('../token.json', json_encode($newToken->jsonSerialize(), JSON_PRETTY_PRINT));
echo 'OK';