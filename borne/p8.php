<?php
use Classes\Tube;
$tube8 = new Tube();

$json .= '"autotune": {
               "type": "notes",
               "channel": 8,
               "notes": [';

$measure =1;

$keys_used = array();

foreach($format as $key=>$section){

    $section_length = $general_lengths[$section];

    if (str_starts_with($section,'text')) {
        $keys_used []= $key;

        for($x=0; $x<$section_length; $x++) {

            $chord = $chords_per_part[$section][$x];
            $note_autotune = $tube8->getAutotune($song_mood, $chord);
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

    }else{
        $measure += $section_length;
    }

    if($key != array_key_last($format) && in_array($key,$keys_used)){
        $json .= ',';
    }

}

$json = rtrim($json, ',');

$json .= ']},';

?>