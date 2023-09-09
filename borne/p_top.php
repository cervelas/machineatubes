<?php
use Classes\Tube;
$tubet = new Tube();
$channel = $tubet->getToplineChannel($song_mood);

$json .= '"toplines": {
               "type": "notes",
               "channel": '.$channel.',
               "notes": [';

$measure = 1;
$keys_used = array();

$note_pitch = $tubet->getToplinePitch();

foreach($format as $key=>$section) {
    $section_length = $general_lengths[$section];
    if (in_array($section, $go_topline)) {
        $keys_used []= $key;
        for($x=0; $x<$section_length; $x++) {
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
