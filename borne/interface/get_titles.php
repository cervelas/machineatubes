<?php
use Classes\Tube;
require_once '../autoloader.php';

if(isset($_SESSION['song_mood'])){
    $machine = new Tube();

    $_SESSION['song_mood_name'] = $machine->getMoodName($_SESSION['song_mood']);
    $_SESSION['midi_channel'] = $machine->getChannel($_SESSION['song_mood']);

    $song_titles = $machine->getRandomTitles($_SESSION['song_mood'], 4, '../lyrics/');

    foreach($song_titles as $song_title){
        echo '<a class="title_init" href="javascript:submitInfo(\'song_title\',\''.urlencode(addslashes($song_title)).'\');">'.$song_title.'</a>';
    }
}

