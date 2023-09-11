<?php
use Classes\Tube;
$tube1 = new Tube();

$stopall = 12;
$json .= '"settings": {
               "type": "notes",
               "channel": 1,
               "notes": [
                        {
                        "beat": 0,
                        "note": '.$stopall.',
                        "duration": 4
                        },';

$stop_drums_note = $tube1->getStopDrums();
$stop_arpeggiato_note = $tube1->getStopArpeggiato();
$stop_topline_note = $tube1->getStopTopline();

$measure = 0;

foreach($format as $section){
    $section_length = $general_lengths[$section];

    if(in_array($section,$stop_drums)){
        $note_pitch = $tube1->getChordPitch($stop_drums_note['step'],$stop_drums_note['do_alter'],$stop_drums_note['octave']);
        $json .= '{
                "beat": '.($measure * 4).',
                "note": '.$note_pitch.',
                "duration": 4
        },';
    }

    if(in_array($section,$stop_arpeggiato)){
        $note_pitch = $tube1->getChordPitch($stop_arpeggiato_note['step'],$stop_arpeggiato_note['do_alter'],$stop_arpeggiato_note['octave']);
        $json .= '{
                "beat": '.($measure * 4).',
                "note": '.$note_pitch.',
                "duration": 4
        },';
    }
    
    if(in_array($section,$stop_topline)){
        $note_pitch = $tube1->getChordPitch($stop_topline_note['step'],$stop_topline_note['do_alter'],$stop_topline_note['octave']);
        $json .= '{
                "beat": '.($measure * 4).',
                "note": '.$note_pitch.',
                "duration": 4
        },';
    }

    $measure += $general_lengths[$section];
}



$json .='{
    "beat": '.($measure * 4).',
                    "note": '.$stopall.',
                    "duration": 4
            }
            ]
            },';

?>
