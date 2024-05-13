<?php

require_once("texts_dedicace.php");
require_once("cereprocs_logins.php");

$text = mb_convert_encoding(stripslashes($texts_dedicace[array_rand($texts_dedicace)]), 'UTF-8');

$credentials = 'Authorization: Basic '.base64_encode(mb_convert_encoding($cereproc_dedicace_login, 'UTF-8'));

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://api.cerevoice.com/v2/auth");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$headers = [
    'accept: application/json',
    $credentials
];

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$server_output = curl_exec($ch);
$server_output_arr = json_decode($server_output, true);

curl_close ($ch);

// Further processing ...
$res = json_decode($server_output, true);
$access_token = $res['access_token'];

if($access_token) {

    $ch = curl_init();

    $speech_headers = ['Authorization: Bearer ' . $access_token,
        'accept: audio/mpeg',
        'Content-Type: text/plain'];

    $voice = urlencode('Bastien Bron-CereWave');

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $text);
    curl_setopt($ch, CURLOPT_URL, 'https://api.cerevoice.com/v2/speak?voice='.$voice.'&audio_format=mp3&sample_rate=16000&language=fr&streaming=true');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $speech_headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // ABSOLUTELY NECESSARY IF I WANT TO SAVE EVERYTHING IN A VAR!!
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    $response = curl_exec($ch);
    curl_close($ch);

    if (!file_exists('audio/dedicaces')){
        mkdir('audio/dedicaces', 0777, true);
    }

    $cereproc_audio_url = 'audio/dedicaces/'.$_SESSION['song_id'].'.mp3';
    if(file_put_contents($cereproc_audio_url, $response)){
        include "did_getTalk.php";
    }

}

?>
