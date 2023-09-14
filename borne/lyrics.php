<?php
use Classes\Tube;

$lyrcsv = new Tube();
$song_filename = $lyrcsv->getSongInfo($song_title_id)['filename'];
$csvfile = "lyrics/".$song_mood."/".$song_filename.".csv";
$lyrics = $lyrcsv->getLyrics($csvfile);

$json .= '
            "lyrics": {
            "type": "lyrics",
            "lyrics": [ ';

                foreach($lyrics as $beat=>$text){
                    $json .= '{ "beat": '.($beat * 4).', "text": "'.$text.'" }';
                    if($beat != array_key_last($lyrics)){
                        $json .= ', ';
                    }
                }
$json .= ']
        }
';

?>
