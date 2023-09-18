<?php
use Classes\Tube;
$tubes = new Tube();

//get lyrics for title id

$singing = $tubes->getSinging($song_title_id);
$channel = $singing['channel'];
$note_pitch = $singing['pitch'];
$measure = 0;

$json .= '"voix": {
               "type": "notes",
               "channel": '.$channel.',
               "notes": [{
                    "beat": ' . ($measure * 4) . ',
                    "note": ' . $note_pitch . ',
                    "duration": 4
                }]
                },';

?>
