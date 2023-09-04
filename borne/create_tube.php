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

include "song_format.php";
include "json_init.php";

/*
if (!file_exists('audio/'.$directory)){
    mkdir('audio/'.$directory, 0777, true);
}
file_put_contents('audio/'.$directory.'/song.xml', $xml);
*/

?>


