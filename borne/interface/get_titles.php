<?php
use Classes\Tube;
require_once '../autoloader.php';

if(isset($_SESSION['song_mood'])){
    $machine = new Tube();

    $_SESSION['song_mood_name'] = $machine->getMoodName($_SESSION['song_mood']);
    $_SESSION['midi_channel'] = $machine->getChordChannel($_SESSION['song_mood']);

    $song_title_ids = $machine->getRandomTitles($_SESSION['song_mood'], 4);
    $circle_colors = array("green", "yellow", "blue", "red");

    foreach($song_title_ids as $key=>$song_title_id){
        $circle_class = $circle_colors[$key]."_circle";
        $song_keyword = $machine->getSongInfo($song_title_id)['keyword'];
        echo '<a class="title_init '.$circle_class.'" href="javascript:submitInfo(\'song_title_id\',\''.$song_title_id.'\');"><span class="bluebg">>'.$song_keyword.'</span></a>';
    }
}

