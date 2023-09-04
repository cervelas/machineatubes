<?php
session_start();

foreach($_POST as $info_type => $info){
    $_SESSION[$info_type] = addslashes($info);

    if($info_type == 'song_mood'){
        include_once('get_titles.php');
    }else{
        echo 'ok';
    }

}

?>