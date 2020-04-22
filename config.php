
<?php
require_once 'google-api-php-client-2.4.0/vendor/autoload.php';

$google_client = new Google_Client();
$google_client->setClientId('967572736019-aaumgeii8kcq90avp8birfr2bktu0gvo');
$google_client->setClientSecret('2DnmwuaxvSg6a_N0cwRqipIL');
$google_client->setRedirectUri('http://localhost/youtube.php');
$google_client->setPrompt('consent');

session_start();