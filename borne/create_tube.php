<?php
use Classes\Tube;
$midi_tube = new Tube();

setlocale(LC_CTYPE, 'fr_FR.UTF-8');
$url = 'http://192.168.1.20:23456/play';

$directory = strtolower($song_title);
$directory = iconv('UTF-8', 'ASCII//IGNORE', $directory);
$directory = str_replace([" ", "'", "’", "-", "?", "!", ",", "&"],"", $directory);
$directory = $song_id.'_'.$directory;
$_SESSION['directory'] = $directory;

$midi_channel = $midi_tube->getChordChannel($song_mood);
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

$url = 'http://192.168.1.20:23456/play';

$json_obj = json_decode($json);

$json = json_encode($json_obj);

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

// Si on arrive là c'est que tout s'est bien passé !

echo "bravo ! le numero de ta chanson est le " . $json_obj->numero . "<br><a href='/index.php'>retour à la case départ</a>";

/*
if (!file_exists('audio/'.$directory)){
    mkdir('audio/'.$directory, 0777, true);
}
file_put_contents('audio/'.$directory.'/song.xml', $xml);
*/

?>


