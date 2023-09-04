<?php
use Classes\Tube;
$tube6 = new Tube();

$json .= '"drums": {
       "type": "notes",
       "channel": 6,
       "notes": [
                ';

$go_drums_note = $tube6->getGoDrums($song_style);
$go_addons_note = $tube6->getAddons($song_addons);
$measure = 1;

foreach($format as $key=>$section) {
    $section_length = $general_lengths[$section];

    if (in_array($section, $go_drums)) {

        $note_pitch = $tube6->getChordPitch($go_drums_note['step'], $go_drums_note['do_alter'], $go_drums_note['octave']);

        $json .= '{
                "beat": ' . ($measure * 4) . ',
                "note": ' . $note_pitch . ',
                "duration": 4
        },';
    }

    if (in_array($section, $go_addons)) {
        $note_pitch_a = $tube6->getChordPitch($go_addons_note['step'], $go_addons_note['do_alter'], $go_addons_note['octave']);
        $json .= '{
                "beat": ' . ($measure * 4) . ',
                "note": ' . $note_pitch_a . ',
                "duration": 4
        },';
    }

    $measure += $general_lengths[$section];

}

    $json = rtrim($json, ',');
    $json .= ']},';

?>