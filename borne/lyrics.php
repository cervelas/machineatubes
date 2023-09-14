<?php
use Classes\Tube;

$csvfile = "lyrics/".$song_mood."/".stripslashes($song_title).".csv";
$lyrcsv = new Tube();
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
        },
';

?>
