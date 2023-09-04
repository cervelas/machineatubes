<?php
use Classes\Tube;
$midi_tube = new Tube();

$directory = strtolower($song_title);
setlocale(LC_CTYPE, 'fr_FR.UTF-8');
$directory = iconv('UTF-8', 'ASCII//IGNORE', $directory);
$directory = str_replace([" ", "'", "’", "-", "?", "!", ",", "&"],"", $directory);
$directory = $song_id.'_'.$directory;
$_SESSION['directory'] = $directory;

$midi_channel = $midi_tube->getChannel($song_mood);
$chords = $midi_tube->getChords($song_mood);
$chords_style = $drums_style = $midi_tube->getChordsDrums($song_style);

foreach($chords as $chord_arr){
    $chord = $chord_arr['chord'];
    $chords_equiv[$chord] = $midi_tube->getChordEquiv($song_mood,$chords_style,$chord);
    $chords_pitch[$chord] = $midi_tube->getChordPitch($chords_equiv[$chord]['step'], $chords_equiv[$chord]['do_alter'], $chords_equiv[$chord]['octave']);
}

$json = "";

include "song_format.php";
include "json_init.php";

$url = 'http://localhost:23456/play';

echo $json;

$json = json_encode(json_decode($json));

if(json_last_error() > 0){
    echo "ERROR in JSON: " . json_last_error_msg();
    var_dump($json);
}

// use key 'http' even if you send the request to https://...
$options = [
    'http' => [
        'header'=>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n",
        'method' => 'POST',
        'content' => $json,
    ],
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === false) {
    throw new \Exception('SENDING SONG ERROR');
}

/*
if (!file_exists('audio/'.$directory)){
    mkdir('audio/'.$directory, 0777, true);
}
file_put_contents('audio/'.$directory.'/song.xml', $xml);
*/

?>


