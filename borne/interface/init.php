<?php
session_start();
$variant = round(rand(1,2));

require_once '../gpio.php';
ledsOFF();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../styles.css" type="text/css" />
    <title>La Machine à Tubes</title>
    <script>
        const types_order = ['start', 'video_intro', 'user_name', 'video_enchante', 'variant', 'song_mood', 'song_style', 'song_tempo', 'song_title_id', 'video_outro'];
        let info_type;
        let info;
        let next_element;
        let next_id;
        let next_inner_elem;
        let variant;

        window.addEventListener("keydown",
            (event) => {
                let entered = event.key;
                switch (entered) {
                    case '1':
                        if(!types_order.includes(next_id)){
                            document.getElementById("touch_sound").src = 'sounds/jeton.mp3';
                            document.getElementById("touch_sound").play();
                            document.getElementById("start_div").style.display = "block";
                            next_id = "start";
                        }
                        break;
                    case '2':
                        //touche verte, confirmation
                        console.log("on est a" + next_id);
                        document.getElementById("touch_sound").src = "sounds/vert.mp3";
                        document.getElementById("touch_sound").play();
                        switch(next_id){
                            case "start":
                                submitInfo("start");
                                break;
                            case "song_mood":
                                submitInfo('song_mood','D');
                                break;
                            case "song_style":
                                submitInfo('song_style','16beat');
                                break;
                            case "song_tempo":
                                submitInfo('song_tempo','95');
                                break;
                            case "song_title_id":
                                let params = fParams("green");
                                submitInfo(params[0],params[1]);
                                console.log(params[0] + params[1]);
                                break;
                            default:
                                break;
                        }
                        break;
                    case '3':
                        console.log("on est a" + next_id);
                        document.getElementById("touch_sound").src = "sounds/jaune.mp3";
                        document.getElementById("touch_sound").play();
                        switch(next_id){
                            case "song_mood":
                                submitInfo('song_mood','C');
                                break;
                            case "song_style":
                                submitInfo('song_style','bossa');
                                break;
                            case "song_tempo":
                                submitInfo('song_tempo','108');
                                break;
                            case "song_title_id":
                                let params = fParams("yellow");
                                submitInfo(params[0],params[1]);
                                console.log(params[0] + params[1]);
                                break;
                            default:
                                break;
                        }
                        break;
                    case '4':
                        console.log("on est a" + next_id);
                        document.getElementById("touch_sound").src = "sounds/bleu.mp3";
                        document.getElementById("touch_sound").play();
                        switch(next_id){
                            case "song_mood":
                                submitInfo('song_mood','Ab');
                                break;
                            case "song_style":
                                submitInfo('song_style','disco');
                                break;
                            case "song_tempo":
                                submitInfo('song_tempo','120');
                                break;
                            case "song_title_id":
                                let params = fParams("blue");
                                submitInfo(params[0],params[1]);
                                console.log(params[0] + params[1]);
                                break;
                            default:
                                break;
                        }
                        break;
                    case '5':
                        console.log("on est a" + next_id);
                        document.getElementById("touch_sound").src = "sounds/rouge.mp3";
                        document.getElementById("touch_sound").play();
                        switch(next_id){
                            case "song_mood":
                                submitInfo('song_mood','joker');
                                break;
                            case "song_style":
                                submitInfo('song_style','pop');
                                break;
                            case "song_tempo":
                                submitInfo('song_tempo','140');
                                break;
                            case "song_title_id":
                                let params = fParams("red");
                                submitInfo(params[0],params[1]);
                                console.log(params[0] + params[1]);
                                break;
                            default:
                                break;
                        }
                        break;
                    default:
                        console.log('type unknown');
                }
            });

        function fParams(c){
            let itype, ivalue;
            let colorc = document.getElementsByClassName(c+"_circle");
            for(let x= 0; x < colorc.length; x++){
                if(colorc[x].parentElement.tagName !== "FORM"){
                    let funct_call = colorc[x].href.toString();
                    let from = funct_call.lastIndexOf("(") + 1;
                    let to = funct_call.lastIndexOf(")");
                    let fparams = funct_call.substring(from, to);
                    let virgule = fparams.indexOf(",");
                    itype = fparams.substring(1, virgule-1);
                    ivalue = fparams.substring(virgule+2, fparams.length-1);
                    console.log("type:"+itype+" , value:"+ivalue);
                }
            }
            return Array(itype,ivalue);
        }

        function videoFinished(v){
            if(v === 'intro'){
                submitInfo("video_intro");
            }else if(v === 'enchante'){
                submitInfo("variant");
            }else if(v === 'outro'){
                document.getElementById("loading_gif").style.display = "block";
                window.location = "../index.php?init=true";
            }
        }

        function checkInput(){
            let i = document.getElementById("user_name").value;
            let last = (i.substring(i.length - 1));

            if (last === "2"){
                let val = i.slice(0, -1);
                if(val !== ''){
                    document.getElementById('user_name').value = val;
                    submitInfo('user_name');
                    document.getElementById("user_name").blur();
                }
            }
            if(last === "5"){
                deleteInfo('user_name');
            }
        }

        function submitInfo(t, i = ''){
            info_type = t;
            const element = document.getElementById(info_type+"_div");
            const input = document.getElementById(info_type);

            if(info_type === 'start'){
                info = false;
            }else{
                if(i === ''){
                    if(document.getElementById(info_type).tagName === 'VIDEO'){
                        info = false;
                    }else{
                        info = input.value;
                    }
                }else{
                    info = encodeURI(i);
                }
            }

            if(info_type === 'song_mood' && info === 'joker'){
                const moods_arr = ['D', 'C', 'Ab'];
                info = moods_arr[Math.floor(Math.random()*moods_arr.length)];
            }

            if(info !== false){
                let xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText == 'ok') {
                            doNext();
                        }else if(info_type === 'song_mood'){
                            document.getElementById("song_title_id_div").innerHTML += this.responseText;
                            doNext();
                        }else{
                            document.getElementById("debug").innerHTML = this.responseText;
                        }
                    }
                };
                xhttp.open("POST", "save_init.php", true);
                xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhttp.send(info_type+"="+info);
            }else{
                //if it's video
                doNext();
            }
        }

        function doNext(){
            if (types_order.indexOf(info_type) + 1 < types_order.length) {
                console.log(info_type + info);
                next_id = types_order[types_order.indexOf(info_type) + 1];
                next_inner_elem = document.getElementById(next_id);
                next_element = document.getElementById(next_id + "_div");
                next_element.style.display = 'block';
                if(next_inner_elem !== null){
                    if(next_inner_elem.tagName === 'VIDEO'){
                        setTimeout(() => {
                            next_inner_elem.play();
                        }, 700);
                    }else if(next_inner_elem.tagName === 'INPUT'){
                        next_inner_elem.focus();
                    }
                }
            }
        }

        function deleteInfo(i){
            document.getElementById(i).value = '';
        }

    </script>
</head>
<body>
    <div id="variant_div" style="display:none;">
        <input type="hidden" name="variant" id="variant" value="<?php echo $variant; ?>" />
    </div>

    <div id="audio_div">
        <audio id="touch_sound">
            <source src="sounds/jeton.mp3" type="audio/mpeg">
        </audio>
    </div>

    <div id="loading_gif" style="display: none;">
        <img src="../imgs/loading.gif" />
    </div>

    <div id="welcome" class="bordered">
        <h2 class="section_title"><span class="bluebg">>ACCUEIL</span></h2>
        <img src="../imgs/lamachine_fuzzy.png" />
        <p>METTRE LE CASQUE SUR LES OREILLES <br /> ET INS&Eacute;RER LE JETON POUR <span class="bluebg">>D&Eacute;MARRER</span></p>
    </div>

    <div id="start_div" class="bordered" style="display: none;">
        <p>Bonjour et bienvenue dans <br /><span class="bluebg">>la machine &agrave; tubes</span></p>
        <p>UTILISER LES 4 TOUCHES COLOR&Eacute;ES <br />DU CLAVIER POUR <span class="bluebg">>NAVIGUER</span><br /></p>
            <p>APPUYEZ SUR
            <svg height="0.8em" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 62 61" style="enable-background:new 0 0 62 61; fill:#19FF00;stroke:#5000FF;stroke-width:3;stroke-miterlimit:10;" xml:space="preserve"><circle cx="30.5" cy="30.5" r="28"/></svg>
                POUR <span class="bluebg">>D&Eacute;MARRER</span></p>
    </div>

    <div id="video_intro_div" class="bordered" style="display: none;">
        <h2 class="section_title"><span class="bluebg">>SALUTATIONS</span></h2>
        <video id="video_intro" playsinline onended="videoFinished('intro');">
            <source src="../video/intro.mp4" type="video/mp4">
        </video>
    </div>

    <div id="user_name_div" class="bordered" style="display:none;">
        <h2><span class="bluebg">>PR&Eacute;NOM</span></h2>
        <form name="init_form" id="init_form" method="post" action="../index.php">
            <input type="text" id="user_name" required autocomplete="false" oninput="checkInput();" />
            <a id="submit_name" class="green_circle" href="javascript:submitInfo('user_name');"><span class="bluebg action_button">>VALIDER</span></a><br />
            <a id="delete_name" class="red_circle" href="javascript:deleteInfo('user_name');"><span class="bluebg action_button">>EFFACER</span></a>
        </form>
    </div>

    <div id="video_enchante_div" class="bordered" style="display: none;">
        <h2 class="section_title"><span class="bluebg">>&Agrave; TOI DE JOUER</span></h2>
        <video id="video_enchante" playsinline onended="videoFinished('enchante');">
            <source src="../video/enchante.mp4" type="video/mp4">
        </video>
    </div>

    <div id="song_mood_div" class="bordered" style="display: none;">
        <h2 class="section_title"><span class="bluebg">>HUMEUR</span></h2>
        <img src="../imgs/mood_happy.jpg" onclick="submitInfo('song_mood','D')" />
        <img src="../imgs/mood_sad.jpg" onclick="submitInfo('song_mood','C')" />
        <img src="../imgs/mood_other.jpg" onclick="submitInfo('song_mood','Ab')" />
        <img src="../imgs/mood_joker.jpg" onclick="submitInfo('song_mood','joker')" />
    </div>

    <div id="song_style_div" class="bordered" style="display: none;">
        <h2 class="section_title"><span class="bluebg">>STYLE</span></h2>
        <img src="../imgs/style_16beat_<?php echo $variant; ?>.jpg" onclick="submitInfo('song_style','16beat')" />
        <img src="../imgs/style_bossa_<?php echo $variant; ?>.jpg" onclick="submitInfo('song_style','bossa')" />
        <img src="../imgs/style_disco_<?php echo $variant; ?>.jpg" onclick="submitInfo('song_style','disco')" />
        <img src="../imgs/style_pop_<?php echo $variant; ?>.jpg" onclick="submitInfo('song_style','pop')" />
    </div>

    <div id="song_tempo_div" class="bordered" style="display: none;">
        <h2 class="section_title"><span class="bluebg">>TEMPO</span></h2>
        <img src="../imgs/tempo_95.jpg" onclick="submitInfo('song_tempo','95')" />
        <img src="../imgs/tempo_108.jpg" onclick="submitInfo('song_tempo','108')" />
        <img src="../imgs/tempo_120.jpg" onclick="submitInfo('song_tempo','120')" />
        <img src="../imgs/tempo_140.jpg" onclick="submitInfo('song_tempo','140')" />
    </div>

    <div id="song_title_id_div" class="bordered" style="display: none;">
        <h2 class="section_title"><span class="bluebg">>TH&Egrave;ME</span></h2>
    </div>

    <div id="video_outro_div" class="bordered" style="display: none;">
        <h2 class="section_title"><span class="bluebg">>Merci bravo</span></h2>
        <video id="video_outro" playsinline onended="videoFinished('outro');">
            <source src="../video/outro.mp4" type="video/mp4">
        </video>
    </div>

    <div id="debug"></div>
</body>
</html>
