<?php

use AmoCRM\Client\AmoCRMApiClient;

include_once '../vendor/autoload.php';

if (!isset($_GET['code'])) {
    exit('INVALID_REQUEST');
}

$config = include_once '../config/amocrmConfig.php';

$apiClient = new AmoCRMApiClient(
    $config['CLIENT_ID'],
    $config['CLIENT_SECRET'],
    $config['CLIENT_REDIRECT_URL']
);
$apiClient->setAccountBaseDomain($config['ACCOUNT_DOMAIN']);

$token = $apiClient->getOAuthClient()->getAccessTokenByCode($_GET['code']);

file_put_contents('../token.json', json_encode($token->jsonSerialize(), JSON_PRETTY_PRINT));
echo 'Токен записан';