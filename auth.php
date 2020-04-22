<?php
require 'vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
'54b23520b47946289b727d451ed82d8c',
'6ff570b5c0f3485bbd0697af34f47c1f',
'http://localhost/index.php'
);

$options = [
'scope' => [
'playlist-read-private',
'user-read-private',
],
];

header('Location: ' . $session->getAuthorizeUrl($options));
die();