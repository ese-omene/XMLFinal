<?php

if(!empty($_GET['location'])){
    $key = '&key=AIzaSyAhCCtkorcapo9RjCdxZfTDxl6S-ARvj-Q';
    $maps_url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' .urldecode($_GET['location']) . $key;

    $maps_json = file_get_contents($maps_url);
    $maps_array = json_decode($maps_json, true);

    $lat = $maps_array['results'][0]['geometry']['location']['lat'];
    $lng = $maps_array['results'][0]['geometry']['location']['lng'];
    var_dump($lat);
    var_dump($lng);
//using google places we will print photos near our selection

  // https://maps.googleapis.com/maps/api/place/findplacefromtext/json
    //?input=mongolian%20grill
    //&inputtype=textquery
    //&fields=photos,formatted_address,name,opening_hours,rating
    //&locationbias=circle:2000@47.6918452,-122.2226413
    //&key=YOUR_API_KEY

   $maps = 'https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=' .urldecode($_GET['location']).
   '&inputtype=textquery&fields=photos,formatted_address,name,opening_hours,rating&locationbias=circle:2000@'.$lat.','.$lng. $key;

}



//https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=Museum%20of%20Contemporary%20Art%20Australia&inputtype=textquery&fields=photos,formatted_address,name,rating,opening_hours,geometry&key=AIzaSyAhCCtkorcapo9RjCdxZfTDxl6S-ARvj-Q

//https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=CmRaAAAAwdKUgC3R9tVnrvb6hmI16lckj8oBWY0DvSC2-g2r3EcJTeSyCvho_cH4wGTwT2jcu5lluIixIZTa1MNScHcQbdWHOpFe50Ktz1cmHCPxqpkxM_LGcB0TNaZHsNMoZHHpEhDQtNK6Zy8THANaeoBMkIoQGhQvVfNrwfnzzcoCp6j4f-MIEHOBJA&key=AIzaSyAhCCtkorcapo9RjCdxZfTDxl6S-ARvj-Q

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
        const token = 'BQDF1ROuJAs5SevpQdwW5JXu6ha_bYfdqSQ47dKd4nAh8OZm-DMVtLtmKdSurcXfMKOUJ6G1gDI7Qlkc3XZTrJTRoG2lP6fxklF9h0VYmRXRx-n8XSIstjxI6rtLMhjfKRuAATwnBG5yo4JxGNEqTFAxIZG_XP6CgItNHnAYMRQVhZRYojRlOS8';
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
    };
</script>
<body>
<div class="jumbotron">
    <h1 class="display-4">TORONTO TRAILS</h1>
    <p class="lead"></p>
    <hr class="my-4">
    <p></p>
    <p></p>
    <a class="btn btn-primary btn-lg" href="playlist.php" role="button">GO!</a>
</div>
</body>
</html>