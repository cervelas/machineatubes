<?php

$json = '{
    "name":"'.stripslashes($_SESSION['song_title']).'",
    "tempo": '.$_SESSION['song_tempo'].',
    "ambiance": "'.$_SESSION['song_mood_name'].'",
    "style": "'.$_SESSION['song_style'].'_'.$_SESSION['variant'].'",
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

echo '<p style="font-family:sans-serif;">'.$json.'</p>';

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
    <p>Cr&eacute;ation en cours !<br />
    Ta chanson porte le num&eacute;ro</p>
    <p class="big_number">#'.$song_id.'</p>
    <p>Vous pouvez à présent vous diriger vers la machine.</p>
   
    <script>
    setTimeout(isFinished, 10000); 
    function isFinished(){
        window.location = "interface/init.php";
    }
</script>
</div>
</body>
</html>';


?>

