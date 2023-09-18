<?php
use Classes\Tube;
$tubet = new Tube();
$channel = $tubet->getToplineChannel($song_mood);

$json .= '"toplines": {
               "type": "notes",
               "channel": '.$channel.',
               "notes": [';

$measure = 0;
$keys_used = array();

$note_pitch = $tubet->getToplinePitch();


foreach($format as $key=>$section) {
    $section_length = $general_lengths[$section];

    if (in_array($section, $go_topline)) {

        $json .= '{
                "beat": ' . ($measure * 4) . ',
                "note": ' . $note_pitch . ',
                "duration": 4
        },';
    }

    $measure += $general_lengths[$section];

}

$json = rtrim($json, ',');
$json .= ']},';

?>
