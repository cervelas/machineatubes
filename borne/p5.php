<?php
use Classes\Tube;
$tube5 = new Tube();

$json .= '"arpeggiato": {
               "type": "notes",
               "channel": 5,
               "notes": [';

//$go_arpeggiato_note = $tube5->getGoDrums($song_style);
$measure = 1;

$go_arpeggiato_note = $tube5->getGoDrums($song_style);
$measure = 0;
$keys_used = array();

foreach($format as $key=>$section) {
    $section_length = $general_lengths[$section];
    if (in_array($section, $go_arpeggiato)) {
        $keys_used []= $key;
        for($x=0; $x<$section_length; $x++) {
            $chord = $chords_per_part[$section][$x];
            $go_arpeggiato_note = $tube5->getArpeggiato($song_mood,$chord);
            $note_pitch = $tube5->getChordPitch($go_arpeggiato_note['step'], $go_arpeggiato_note['do_alter'], $go_arpeggiato_note['octave']);

            $json .= '{
                "beat": ' . ($measure * 4) . ',
                "note": ' . $note_pitch . ',
                "duration": 4
                 }';

            if($x<$section_length-1){
                $json .= ',';
            }

            $measure++;
        }

    }else{
        $measure += $general_lengths[$section];
    }

    if($key != array_key_last($format) && in_array($key,$keys_used)){
        $json .= ',';
    }
}

$json = rtrim($json, ',');
$json .= ']},';

?>
