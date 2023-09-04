<?php
session_start();
use Classes\Tube;
require_once 'autoloader.php';

if(!$_GET['init']){
    session_destroy();
    header("location:interface/init.php");
}else{

    $tube = new Tube();

    $user_name = $_SESSION['user_name'];
    $song_title = $_SESSION['song_title'];
    $song_mood = $_SESSION['song_mood'];
    $song_mood_name = $_SESSION['song_mood_name'];
    $song_tempo = $_SESSION['song_tempo'];
    $song_style = $_SESSION['song_style'];
    $song_addons = $_SESSION['song_addons'];
    $midi_channel = $_SESSION['midi_channel'];

    $user_id = $tube->insertUser($user_name);
    $song_id = $tube->insertSong($user_id, $song_title, $song_mood, $song_tempo, $song_style, $song_addons);

    $_SESSION['song_id'] = $song_id;
    $_SESSION['user_id'] = $user_id;

    /*
    $filename = "choices.json";
    $fp = fopen($filename, 'w');
    fwrite($fp,$json_init);
    */

    include_once('create_tube.php');

}
?>