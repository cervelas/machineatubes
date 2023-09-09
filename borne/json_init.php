<?php

$json = '{
    "name":"'.stripslashes($_SESSION['song_title']).'",
    "tempo": '.$_SESSION['song_tempo'].',
    "ambiance": "'.$_SESSION['song_mood_name'].'",
    "style": "'.$_SESSION['song_style'].'",
    "prenom": "'.stripslashes($_SESSION['user_name']).'",
    "numero": '.$_SESSION['song_id'].',
    "song": {';

include_once('p1.php');
include_once('pn.php');
include_once('p5.php');
include_once('p6.php');
include_once('p8.php');
include_once('p_top.php');

include_once('lyrics.php');

$json .= '}
}';




?>
