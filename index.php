<?php
require 'vendor/autoload.php';


$session = new SpotifyWebAPI\Session(
    '54b23520b47946289b727d451ed82d8c',
    '6ff570b5c0f3485bbd0697af34f47c1f',
    'http://localhost:8888/XMLFinal/'

);
$api = new SpotifyWebAPI\SpotifyWebAPI();




// Request a access token using the code from Spotify
//echo 'a';
//if(!empty($_GET['code'])&& isset($_GET['code']));
  //  echo 'b';

   // $session->requestAccessToken($_GET['code']);


//    $refreshToken = $session->getRefreshToken();

try{


        $session->requestAccessToken($_GET['code']);
        $api->setAccessToken($session->getAccessToken());
        $accessToken = $session->getAccessToken();





   // $releases = $api->getNewReleases([ 'country' => 'se', ]);
   // foreach ($releases->albums->items as $album)
   // { echo '<a href="' . $album->external_urls->spotify . '">' . $album->name . '</a> <br>'; }


    // print_r($api->me());
//
} catch (Exception $e) {
    $options = [
       'scope' => [
            'user-read-email',
           'streaming',
           'user-modify-playback-state',
           'user-library-read',
           'user-read-playback-state',
           'playlist-read-collaborative',
'playlist-modify-public',
'playlist-read-private',

'playlist-modify-private'
        ],
    ];

    header('Location: ' . $session->getAuthorizeUrl($options));
    die();
}
//echo 'testing';

$tracks = $api->getMySavedTracks([ 'limit' => 5, ]);
$trackIDs = [];

foreach ($tracks->items as $track) {
   // var_dump($track);
    $track = $track->track;
  //  echo $track->id;

     array_push($trackIDs, $track->id);
   //echo $track->id ;
  //  echo '<p>' .$track->external_urls->spotify.'</p>';
  // echo '<a href="' . $track->external_urls->spotify . '">' . $track->name . '</a> <br>';
}
//print_r($api->getMyDevices());

//$api->createPlaylist([
 //   'name' => 'My shiny playlist'
//]);
$playlists = $api->getUserPlaylists($api->me()->id, [
    'limit' => 5
]);
$currentplaylist = false;

foreach ($playlists->items as $playlist) {
 //print_r($playlist);
 if($playlist->name == 'My jogging playlist') {
     $currentplaylist = $playlist;
     $api->addPlaylistTracks($currentplaylist->id, $trackIDs);

     break;
 }
    echo '<a href="' . $playlist->external_urls->spotify . '">' . $playlist->name . '</a> <br>';
}
if($currentplaylist == false ){
    $api->createPlaylist([
        'name' => 'My jogging playlist'

    ]);
    foreach ($playlists->items as $playlist) {
       // print_r($playlist);
        if($playlist->name == 'My jogging playlist') {
            $currentplaylist = $playlist;
            $api->addPlaylistTracks($currentplaylist->id, $trackIDs);

            break;
        }
        echo '<a href="' . $playlist->external_urls->spotify . '">' . $playlist->name . '</a> <br>';
    }
}



 ?>




<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"
            integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
            crossorigin="anonymous"></script>
</head>


<body>
<iframe src="images.php" width="100%" height="75%" >

</iframe>



<iframe src="https://open.spotify.com/embed/playlist/<?=$currentplaylist->id?>" width="100%" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>

</body>
</html>




