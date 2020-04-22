<?php
require 'vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
    '54b23520b47946289b727d451ed82d8c',
    '6ff570b5c0f3485bbd0697af34f47c1f',
    'http://localhost/playlist.php'
);

// Request a access token using the code from Spotify
$session->requestAccessToken($_GET['code']);

$accessToken = $session->getAccessToken();
$refreshToken = $session->getRefreshToken();

// Store the access and refresh tokens somewhere. In a database for example.

// Send the user along and fetch some data!
header('Location: app.php');
die();