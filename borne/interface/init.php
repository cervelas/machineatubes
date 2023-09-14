<?php
session_start();

$variant = round(rand(1,2));

?>

<html>
<head>
    <link rel="stylesheet" href="../styles.css" type="text/css" />
    <title>La Machine à Tubes</title>
    <script>
        window.addEventListener("keydown",
            (event) => {
                if (event.key === "1") {
                    document.getElementById("press_start").style.display = "block";
                }

            });

        function startForm() {
            document.getElementById("video_intro_div").style.display = "block";
            document.getElementById("video_intro").play();
        }

        function loadOutro(){
            document.getElementById("video_outro_div").style.display = "block";
            document.getElementById("video_outro").play();
        }

        function videoFinished(v){
            if(v === 'intro'){
                document.getElementById("init_form").style.display = "block";
                //document.getElementById("return_intro").style.display = "block";
            }else if(v === 'enchante'){
                submitInfo("variant");
            }else if(v === 'outro'){
                window.location = "../index.php?init=true";
            }
        }

        function hideDiv(d){
            if(d === 'video_intro'){
                document.getElementById("video_intro").play();
            }
            document.getElementById(d).style.display = 'none';
        }
    </script>
</head>
<body>
<div id="variant_div" style="display:none;">
    <input type="hidden" name="variant" id="variant" value="<?php echo $variant; ?>" />
</div>

<div id="welcome" class="bordered">
    <h2 class="section_title"><span class="bluebg">>ACCUEIL</span></h2>
    <img src="../imgs/lamachine_fuzzy.png" />
    <p>INSÉRER LE JETON POUR <span class="bluebg">>D&Eacute;MARRER</span></p>
</div>
<div id="press_start" class="bordered" style="display: none;">
    <p><span class="bluebg">>NAVIGUEZ</span> À L’AIDE DES 4 TOUCHES COLORÉES DU CLAVIER<br />
        APPUYEZ SUR
        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="#19FF00" stroke="#5000FF"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"/></svg>
        POUR DÉMARRER</p>
        <a href="javascript:startForm();"><span>BOUTON VERT</span></a>
</div>
<div id="video_intro_div" class="bordered" style="display: none;">
    <h2 class="section_title"><span class="bluebg">>INTRODUCTION</span></h2>
    <video id="video_intro" playsinline onplay="videoFinished('intro');">
        <source src="../video/intro.mp4" type="video/mp4">
    </video>
   <!-- <p id="return_intro" style="display: none;"><a class="delete_circle" href="javascript:hideDiv('video_intro');"><span class="bluebg">REDEMARRER</span></a></p>-->

</div>
<div id="init_form" class="bordered" style="display: none;">
    <h2><span class="bluebg">>PR&Eacute;NOM</span></h2>
    <form name="init_form" method="post" action="../index.php">
        <div id="user_name_div">
            <input type="text" id="user_name" required autofocus autocomplete="false" /><br />
            <a id="submit_name" class="submit_circle" href="javascript:submitInfo('user_name');"><span class="bluebg">VALIDER</span></a><br />
            <a id="delete_name" class="delete_circle" href="javascript:deleteInfo('user_name');"><span class="bluebg">EFFACER</span></a>
        </div>
    </form>
</div>

<div id="video_enchante_div" class="bordered" style="display: none;">
    <h2 class="section_title"><span class="bluebg">>VIDEO</span></h2>
    <video id="video_enchante" playsinline onplay="videoFinished('enchante');">
        <source src="../video/enchante.mp4" type="video/mp4">
    </video>
</div>

    <div id="song_mood_div" class="bordered" style="display: none;">
        <h2 class="section_title"><span class="bluebg">>HUMEUR</span></h2>
        <img src="../imgs/mood_happy.jpg" onclick="javascript:submitInfo('song_mood','D')" />
        <img src="../imgs/mood_sad.jpg" onclick="javascript:submitInfo('song_mood','C')" />
        <img src="../imgs/mood_other.jpg" onclick="javascript:submitInfo('song_mood','Ab')" />
        <img src="../imgs/mood_joker.jpg" onclick="javascript:submitInfo('song_mood','joker')" />
    </div>

    <div id="song_style_div" class="bordered" style="display: none;">
        <h2 class="section_title"><span class="bluebg">>STYLE</span></h2>
        <img src="../imgs/style_16beat_<?php echo $variant; ?>.jpg" onclick="javascript:submitInfo('song_style','16beat')" />
        <img src="../imgs/style_bossa_<?php echo $variant; ?>.jpg" onclick="javascript:submitInfo('song_style','bossa')" />
        <img src="../imgs/style_disco_<?php echo $variant; ?>.jpg" onclick="javascript:submitInfo('song_style','disco')" />
        <img src="../imgs/style_pop_<?php echo $variant; ?>.jpg" onclick="javascript:submitInfo('song_style','pop')" />
    </div>

    <div id="song_tempo_div" class="bordered" style="display: none;">
        <h2 class="section_title"><span class="bluebg">>TEMPO</span></h2>
        <img src="../imgs/tempo_95.jpg" onclick="javascript:submitInfo('song_tempo',95)" />
        <img src="../imgs/tempo_108.jpg" onclick="javascript:submitInfo('song_tempo',108)" />
        <img src="../imgs/tempo_120.jpg" onclick="javascript:submitInfo('song_tempo',120)" />
        <img src="../imgs/tempo_140.jpg" onclick="javascript:submitInfo('song_tempo',140)" />
    </div>

    <div id="song_title_div" class="bordered" style="display: none;">
        <h2 class="section_title"><span class="bluebg">>TITRE</span></h2>

    </div>

    <div id="video_outro_div" class="bordered" style="display: none;">
        <h2 class="section_title"><span class="bluebg">>OUTRO</span></h2>
        <video id="video_outro" playsinline onplay="videoFinished('outro');">
            <source src="../video/outro.mp4" type="video/mp4">
        </video>
    </div>

    <div id="debug"></div>
<script>
    const types_order = ['user_name', 'video_enchante', 'variant', 'song_mood', 'song_style', 'song_tempo', 'song_title'];
    let info_type;
    let info;
    let next_element;
    let next_id;
    let next_inner_elem;
    let variant;

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
                        next_id = types_order[types_order.indexOf(info_type) + 1];
                        next_inner_elem = document.getElementById(next_id);
                        next_element = document.getElementById(next_id + "_div");
                        //element.style.display = 'none';
                        next_element.style.display = 'block';
                        if(next_inner_elem !== null){
                            if(next_inner_elem.tagName === 'VIDEO'){
                                next_inner_elem.play();
                            }
                        }

                    } else {
                        //console.log(info_type+info);
                        //c'est la fin
                        loadOutro();
                    }
                }else if(info_type === 'song_mood'){
                        document.getElementById("song_title_div").innerHTML += this.responseText;
                        if (types_order.indexOf(info_type) + 1 < types_order.length) {
                            console.log(info_type + info);
                            const next_id = types_order[types_order.indexOf(info_type) + 1];
                            next_element = document.getElementById(next_id + "_div");
                            //element.style.display = 'none';
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

    function deleteInfo(i){
        document.getElementById(i).value = '';
    }

</script>
</body>
</html>
