<?php
use Classes\Tube;
require_once '../autoloader.php';

if(isset($_SESSION['song_mood'])){
    $machine = new Tube();

    $_SESSION['song_mood_name'] = $machine->getMoodName($_SESSION['song_mood']);
    $_SESSION['midi_channel'] = $machine->getChordChannel($_SESSION['song_mood']);

    $song_title_ids = $machine->getRandomTitles($_SESSION['song_mood'], 4);

    foreach($song_title_ids as $song_title_id){
        $song_keyword = $machine->getSongInfo($song_title_id)['keyword'];
        echo '<a class="title_init" href="javascript:submitInfo(\'song_title_id\',\''.$song_title_id.'\');">'.$song_keyword.'</a>';
    }
}

