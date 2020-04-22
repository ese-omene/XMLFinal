<?php
//session_start();
//$url = 'https://www.googleapis.com/youtube/v3';
//$youtube_CFG = array(

 //   'client_id' => '967572736019-aaumgeii8kcq90avp8birfr2bktu0gvo',
 ///   'client_secret' => '2DnmwuaxvSg6a_N0cwRqipIL',
  //  'redirect' => 'http://localhost/youtube.php'
//);

//if (!isset($_SESSION['yt_accesstoken'])){
   // requestToken($url, $youtube_CFG);
//}

///function requestToken($baseURL, $config){

//}


/**
 * Sample PHP code for youtube.playlists.list
 * See instructions for running these code samples locally:
 * https://developers.google.com/explorer-help/guides/code_samples#php
 */

if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    throw new Exception(sprintf('Please run "composer require google/apiclient:~2.0" in "%s"', __DIR__));
}
require_once __DIR__ . '/vendor/autoload.php';

$client = new Google_Client();
$client->setApplicationName('API Final - YouTube');
$client->setScopes([
    'https://www.googleapis.com/auth/youtube.readonly',
]);

// TODO: For this request to work, you must replace
//       "YOUR_CLIENT_SECRET_FILE.json" with a pointer to your
//       client_secret.json file. For more information, see
//       https://cloud.google.com/iam/docs/creating-managing-service-account-keys
$client->setAuthConfig('client_secret.json');
$client->setAccessType('offline');

// Request authorization from the user.
$authUrl = $client->createAuthUrl();
printf("Open this link in your browser:\n%s\n", $authUrl);
print('Enter verification code: ');
$authCode = trim(fgets(STDIN));

// Exchange authorization code for an access token.
$accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
$client->setAccessToken($accessToken);

// Define service object for making API requests.
$service = new Google_Service_YouTube($client);

$queryParams = [
    'channelId' => 'UC_x5XG1OV2P6uZZ5FSM9Ttw',
    'maxResults' => 25
];

$response = $service->playlists->listPlaylists('snippet,contentDetails', $queryParams);
print_r($response);
