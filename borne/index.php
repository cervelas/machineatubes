<?php
session_start();
require_once 'gpio.php';
require_once 'autoloader.php';
use Classes\Tube;

if(!$_GET['init']){
    session_destroy();
    header("location:interface/init.php");
}else{
    
    // Set the value of the pin high (turn it on)
    $pin->setValue(PinInterface::VALUE_HIGH);
    
    $tube = new Tube();

    $user_name = $_SESSION['user_name'];
    $song_title_id = $_SESSION['song_title_id'];
    $song_title = $tube->getSongInfo($song_title_id)['titre'];
    $song_mood = $_SESSION['song_mood'];
    $song_mood_name = $_SESSION['song_mood_name'];
    $song_tempo = $_SESSION['song_tempo'];
    $song_style = $_SESSION['song_style'];
    $midi_channel = $_SESSION['midi_channel'];
    $mood_variant = $_SESSION['variant'];

    $user_id = $tube->insertUser($user_name);
    $song_id = $tube->insertSong($user_id, $song_title, $song_mood, $song_tempo, $song_style);
    $tube->insertUsedTitle($song_title_id);

    $_SESSION['song_id'] = $song_id;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['song_title'] = $song_title;

    include_once('create_tube.php');

    // Set the value of the pin high (turn it on)
    $pin->setValue(PinInterface::VALUE_LOW);
    
}
?>
