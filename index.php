<?php
require 'vendor/autoload.php';

//echo $_SERVER['REQUEST_URI'];
//die();
$session = new SpotifyWebAPI\Session(
    '54b23520b47946289b727d451ed82d8c',
    '6ff570b5c0f3485bbd0697af34f47c1f',
    'http://localhost:8888/XMLFinal/'

// $_SERVER['REQUEST_URI']
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
   // $api->next();
  //  $api->play();

    //$api->play(false, [
    //    'uris' => ['https://open.spotify.com/track/3IJCSQoLF4YzPAKaxq2JLb'],
   // ]);



    //$api->pause();

   // $releases = $api->getNewReleases([ 'country' => 'se', ]);
   // foreach ($releases->albums->items as $album)
   // { echo '<a href="' . $album->external_urls->spotify . '">' . $album->name . '</a> <br>'; }


     //print_r($api->me()->id);
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

//$api->addPlaylistTracks($currentplaylist->id, $trackIDs);
//print_r($currentplaylist->id);

//$api->play(false, [
  //  'uris' => ['https://open.spotify.com/track/3IJCSQoLF4YzPAKaxq2JLb'],
//]);
// Store the access and refresh tokens somewhere. In a database for example.

// Send the user along and fetch some data!
//header('Location: app.php');
//die();
?>




<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">

</head>
<script src="https://sdk.scdn.co/spotify-player.js"></script>
<script>
    window.onSpotifyWebPlaybackSDKReady = () => {
        const token = '<?=$accessToken?>';
        const player = new Spotify.Player({
            name: 'Web Playback SDK Quick Start Player',
            getOAuthToken: cb => { cb(token); }
        });

        // Error handling
        player.addListener('initialization_error', ({ message }) => { console.error(message); });
        player.addListener('authentication_error', ({ message }) => { console.error(message); });
        player.addListener('account_error', ({ message }) => { console.error(message); });
        player.addListener('playback_error', ({ message }) => { console.error(message); });

        // Playback status updates
        player.addListener('player_state_changed', state => { console.log(state); });

        // Ready
        player.addListener('ready', ({ device_id }) => {
            console.log('Ready with Device ID', device_id);
        });

        // Not Ready
        player.addListener('not_ready', ({ device_id }) => {
            console.log('Device ID has gone offline', device_id);
        });

        // Connect to the player!
       player.connect();





       // player.togglePlay().then(() => { console.log('Toggled playback!'); });
       // player.connect().then(success => { if (key) { console.log('The Web Playback SDK successfully connected to Spotify!'); } })
    };
</script>
<body>
<div class="jumbotron">
    <h1 class="display-4">LET'S RUN</h1>
<p class="lead">Let's go Back to a Time When We Would Run Outside</p>
    <hr class="my-4">
<p>Join me on a visual journey throough some of my favorite parks and trails run</p>
<p>It Might be cold out and covid got your trapped inside, so take some time to enjoy the sites</p>
    <p>Enter your favorite city below!</p>
    <p>Press Play in Spotify on your Phone to help add some tunes to the journey</p>

    <form action="/">
        <input type="text" name="location" />
        <button type="submit">Let's Go!</button>
    </form>
</div>
<iframe src="https://open.spotify.com/embed/playlist/<?=$currentplaylist->id?>" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>

</body>
</html>

