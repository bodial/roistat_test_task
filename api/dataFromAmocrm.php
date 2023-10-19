<?php

use AmoCRM\Client\AmoCRMApiClient;
use League\OAuth2\Client\Token\AccessToken;

include_once '../vendor/autoload.php';
include_once '../src/Request.php';

$req = new Request('','','','');
echo 'КОНТАКТЫ:<br>';
$req->showAllContacts();
echo 'СДЕЛКИ:<br>';
$req->showAllLeads();