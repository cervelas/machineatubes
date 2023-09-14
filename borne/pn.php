<?php

use Classes\Tube;
$tuben = new Tube();

$json .= '"chords sample": {
               "type": "notes",
               "channel": '.$_SESSION['midi_channel'].',
               "notes": [
                        ';

$measure = 0;

$mood = $_SESSION['song_mood'];

foreach($format as $key=>$section){
    $section_length = $general_lengths[$section];
    for($x=0; $x<$section_length; $x++) {
        $chord = $chords_per_part[$section][$x];
        $chord_equiv = $tuben->getChordEquiv($mood,$chords_style,$chord);
        $note_pitch = $tuben->getChordPitch($chord_equiv['step'],$chord_equiv['do_alter'],$chord_equiv['octave']);
        $json .= '{
                "beat": '.($measure * 4).',
                "note": '.$note_pitch.',
                "duration": 4
        }';
        if($x<$section_length-1){
            $json .= ',';
        }
        $measure++;
    }
    //$measure += $general_lengths[$section];
    if($key != array_key_last($format)){
        $json .= ',';
    }
}

$json .= ']},';


?>
