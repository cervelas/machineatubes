<?php

include_once('cereproc_dedicace.php');
include_once('texts_dedicace.php');

$song_keyword = $keywords_eng[$_SESSION['song_title_id'] - 1];

$json = '{
    "name":"'.$_SESSION['song_title_eng'].'",
    "tempo": '.$_SESSION['song_tempo'].',
    "ambiance": "'.$song_keyword.'",
    "style_text": "'.$style[$_SESSION['song_style']].'",
    "style": "'.$_SESSION['song_style'].'_'.$_SESSION['variant'].'",
    "prenom": "'.$_SESSION['user_name'].'",
    "numero": '.$_SESSION['song_id'].',
    "id_dedicace": '.$_SESSION['dedicace_id'].',
    "id_video": "'.$talk_id.'",';

$json .= ' "song": {';

include_once('p1.php');
include_once('pn.php');
include_once('p5.php');
include_once('p6.php');
include_once('p8.php');
include_once('p_top.php');
include_once ('p_singing.php');
include_once('lyrics.php');

$json .= '}
}';

echo '
<html>
<head>
    <link rel="stylesheet" href="styles.css" type="text/css" />
    <title>La Machine à Tubes</title>
</head>
<body>
<div id="last_screen" class="bluebg">
<h2 class="section_title">MY NAME IS FUZZY</h2>
    <img src="imgs/lamachine.png" />
    <p>The song is being created!<br />
    Your hit number is</p>
    <p class="big_number">#'.$song_id.'</p>
    <p>Take off the headphones and head to the machine</p>';

    echo '<script>
    setTimeout(isFinished, 10000); 
    function isFinished(){
        window.location = "interface/init.php";
    }
    </script>
    </div>
    </body>
    </html>';

?>

