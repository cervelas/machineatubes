<?php
use Classes\Tube;
$tube6 = new Tube();

$json .= '"drums": {
       "type": "notes",
       "channel": 6,
       "notes": [
                ';

$go_drums_note = $tube6->getGoDrums($song_style);

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

    foreach($avail_addons as $addon_name){
        $go_addon = 'go_'.$addon_name;
        $go_addon_note = 'go_'.$addon_name.'_note';
        $$go_addon_note = $tube6->getAddons($addon_name);

        if (in_array($section, $$go_addon)) {
            $note_pitch_a = $tube6->getChordPitch($$go_addon_note['step'], $$go_addon_note['do_alter'], $$go_addon_note['octave']);
            $json .= '{
                "beat": ' . ($measure * 4) . ',
                "note": ' . $note_pitch_a . ',
                "duration": 4
        },';
        }
    }


    $measure += $general_lengths[$section];

}

    $json = rtrim($json, ',');
    $json .= ']},';

?>
