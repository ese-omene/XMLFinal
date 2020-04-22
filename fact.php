<?php
$url = 'https://api.fungenerators.com';
   // curl
   // -X
//GET "http://api.fungenerators.com/fact/random?category=Countries&subcategory=USA"
//-H  "accept: application/json"
//-H  "X-Fungenerators-Api-Secret: api_key"

$req = $url . '/fact/random/';
$header = array(
    'accept: application/json',
    'X-Fungenerators-Api-Secret:  '
);
    $c = curl_init();
curl_setopt($c, CURLOPT_URL, $req);
//curl_setopt($c, CURLOPT_HTTPHEADER, $header);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$result = json_decode(curl_exec($c));

print_r($result);
