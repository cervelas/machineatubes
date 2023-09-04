<?php
session_start();

?>

<html>
<head>
    <link rel="stylesheet" href="../styles.css" type="text/css" />
    <title>La Machine à Tubes</title>
</head>
<body>
<div id="welcome">

</div>
<form id="init_form" name="init_form" method="post" action="../index.php">
    <div id="user_name_div">
        <input type="text" id="user_name" placeholder="Prénom" required /><br />
        <a class="submit_init" id="submit_name" href="javascript:submitInfo('user_name');">Suivant</a>
    </div>
</form>
    <div id="song_mood_div" class="image_choices" style="display: none;">
        <img src="../imgs/mood_happy.jpg" onclick="javascript:submitInfo('song_mood','D')" />
        <img src="../imgs/mood_sad.jpg" onclick="javascript:submitInfo('song_mood','C')" />
        <img src="../imgs/mood_other.jpg" onclick="javascript:submitInfo('song_mood','Ab')" />
        <img src="../imgs/mood_joker.jpg" onclick="javascript:submitInfo('song_mood','joker')" />
    </div>

    <div id="song_title_div" style="display: none;">

    </div>

    <div id="song_tempo_div" class="image_choices" style="display: none;">
        <img src="../imgs/tempo_80.jpg" onclick="javascript:submitInfo('song_tempo',80)" />
        <img src="../imgs/tempo_100.jpg" onclick="javascript:submitInfo('song_tempo',100)" />
        <img src="../imgs/tempo_120.jpg" onclick="javascript:submitInfo('song_tempo',120)" />
        <img src="../imgs/tempo_140.jpg" onclick="javascript:submitInfo('song_tempo',140)" />
    </div>
    <div id="song_style_div" class="image_choices" style="display: none;">
        <img src="../imgs/style_16beat.jpg" onclick="javascript:submitInfo('song_style','16beat')" />
        <img src="../imgs/style_bossa.jpg" onclick="javascript:submitInfo('song_style','bossa')" />
        <img src="../imgs/style_disco.jpg" onclick="javascript:submitInfo('song_style','disco')" />
        <img src="../imgs/style_pop.jpg" onclick="javascript:submitInfo('song_style','pop')" />
    </div>
    <div id="song_addons_div" class="image_choices" style="display: none;">
        <img src="../imgs/addons_claps.jpg" onclick="javascript:submitInfo('song_addons','clap')" />
    </div>
    <div id="debug"></div>
<script>
    const types_order = ['user_name', 'song_mood', 'song_title', 'song_tempo', 'song_style', 'song_addons'];
    let info_type;
    let info;
    let next_element;

    function submitInfo(t, i = ''){
        info_type = t;
        const element = document.getElementById(info_type+"_div");
        const input = document.getElementById(info_type);
        if(i === ''){
            info = input.value;
        }else{
            info = encodeURI(i);
        }

        if(info_type === 'song_mood' && info === 'joker'){
            const moods_arr = ['D', 'C', 'Ab'];
            info = moods_arr[Math.floor(Math.random()*moods_arr.length)];
        }

        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == 'ok') {
                    if (types_order.indexOf(info_type) + 1 < types_order.length) {
                        console.log(info_type + info);
                        const next_id = types_order[types_order.indexOf(info_type) + 1];
                        next_element = document.getElementById(next_id + "_div");
                        element.style.display = 'none';
                        next_element.style.display = 'block';
                    } else {
                        //console.log(info_type+info);
                        window.location = "../index.php?init=true";
                    }
                }else if(info_type === 'song_mood'){
                    document.getElementById("song_title_div").innerHTML = this.responseText;
                    if (types_order.indexOf(info_type) + 1 < types_order.length) {
                        console.log(info_type + info);
                        const next_id = types_order[types_order.indexOf(info_type) + 1];
                        next_element = document.getElementById(next_id + "_div");
                        element.style.display = 'none';
                        next_element.style.display = 'block';
                    }
                }else{
                    document.getElementById("debug").innerHTML = this.responseText;
                }
            }
        };
        xhttp.open("POST", "save_init.php", true);
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.send(info_type+"="+info);
    }
</script>
</body>
</html>