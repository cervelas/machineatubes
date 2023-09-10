<?php
use Classes\Tube;
$tube6 = new Tube();

$json .= '"drums": {
       "type": "notes",
       "channel": 6,
       "notes": [
                ';

$go_drums_note = $tube6->getGoDrums($song_style);
$go_clap_note = $tube6->getAddons('clap');
$go_hh_note = $tube6->getAddons('hh');
$go_kick_note = $tube6->getAddons('kick');
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

    if (in_array($section, $go_clap)) {
        $note_pitch_a = $tube6->getChordPitch($go_clap_note['step'], $go_clap_note['do_alter'], $go_clap_note['octave']);
        $json .= '{
                "beat": ' . ($measure * 4) . ',
                "note": ' . $note_pitch_a . ',
                "duration": 4
        },';
    }

    if (in_array($section, $go_hh)) {
        $note_pitch_a = $tube6->getChordPitch($go_hh_note['step'], $go_hh_note['do_alter'], $go_hh_note['octave']);
        $json .= '{
                "beat": ' . ($measure * 4) . ',
                "note": ' . $note_pitch_a . ',
                "duration": 4
        },';
    }

    if (in_array($section, $go_kick)) {
        $note_pitch_a = $tube6->getChordPitch($go_kick_note['step'], $go_kick_note['do_alter'], $go_kick_note['octave']);
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
