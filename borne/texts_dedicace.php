<?php

$style = array(
    "bossa"=>"tropical",
    "pop"=>"pop",
    "16beat"=>"urban",
    "disco"=>"disco"
);

$texts_dedicace = array(
    "Et hop, encore un tube composé vite fé, bien fé! Il s’appelle: ".$_SESSION['song_title'].". Et il a été écrit spécialement pour: ".$_SESSION['user_name'].". J’ai essayé de coller à tes zenvies de chanson ".$style[$_SESSION['song_style']].", on écoute? C’est parti!",
    "Hello! Espérons, qu’il n’y ait pas de bug ce coup-ci. Si tout va bien, on va pouvoir écouter: ".$_SESSION['song_title'].". Elle a été écrite sur les conseils de: ".$_SESSION['user_name'].". C’est une belle chanson aux couleurs ".$_SESSION['song_style'].". Pif, paf pouf, allonzi.",
    "Hello! La prochaine chanson s’appelle: ".$_SESSION['song_title'].". Je l’ai composée pour: ".$_SESSION['user_name'].", qui semblait vouloir une chanson aux notes: ".$style[$_SESSION['song_style']].". Voyons ce que ça donne. Ha ha ha. Bisous ".$_SESSION['user_name'],
    "C’est bon, je suis prêt! Attention, ".$_SESSION['user_name'].", la prochaine est pour toi! Elle s’appelle: ".$_SESSION['song_title'].". Pour écrire cette belle chanson, j’ai mélangé tes souhaits et mes inspirations. Sur une musique: ".$style[$_SESSION['song_style']].". Reste plu qu’à espérer que ça te plaise. 3, 2, 1 go!",
    "Cher ".$_SESSION['user_name'].", j’ai travaillé dur pour achever l’écriture de ".$_SESSION['song_title'].", tel que tu l’a rêvé. Des notes ".$style[$_SESSION['song_style']]." sur un texte qui j’espère te parlera. Voilà. Bien du plaisir. Attention ".$_SESSION['user_name'].", je lance la machine, salut.",
    "La prochaine chanson est pour toi: ".$_SESSION['user_name']."! Elle s’appelle: ".$_SESSION['song_title'].", et je l’ai écrite du mieux que j’ai pu, mais j’étais un peu à la bourre. Ne m’en veux pas si c’est nul. Bisous ".$_SESSION['user_name'],
    "C’est pas pour me vanter, mais je pense que la prochaine chanson touche au génie! Je l’ai écrite pour: ".$_SESSION['user_name'].", et elle s’appelle: ".$_SESSION['song_title'].". Franchement, je crois que c’est pas mal. ".$_SESSION['user_name'].", accroche-toi!",
    "Bon, c’était pas facile, mais j’ai finalement terminé l’écriture de ".$_SESSION['song_title'].". Spécialement pour ".$_SESSION['user_name'].". Une chanson un peu ".$style[$_SESSION['song_style']]." qui j’espère saura faire mouche. Allez, on écoute."
);


$texts_dedicace_eng = array(
    "And there you go, another hit composed quickly and efficiently! It's called: ".$_SESSION['song_title']." and it was written especially for: ".$_SESSION['user_name'].". I’ve tried to match the ".$style[$_SESSION['song_style']] . "energy you were into. Shall we listen? Here we go!",
    "Hello! Let's hope there are no bugs this time. If all goes well, we’ll be able to listen to: ".$_SESSION['song_title'].". It was written based on the suggestions of: ".$_SESSION['user_name'].". It's a beautiful song with some ". $_SESSION['song_style'] . " accents. Let’s get started!",
    "Hello! The next song is called: ".$_SESSION['song_title'].". I composed it for: ".$_SESSION['user_name'].", who seemed to want a song with some ".$style[$_SESSION['song_style']]." notes. Let’s see how it turns out. Ha ha ha. Kisses, ".$_SESSION['user_name'].".",
    "All set, I'm ready! Watch out, ".$_SESSION['user_name'].", the next one is for you! It's called: ".$_SESSION['song_title'].". To write this beautiful song, I combined your wishes with my inspirations, set to a music in a ".$style[$_SESSION['song_style']]." style. Now we just have to hope you like it. 3, 2, 1, go!",
    
    "Dear ".$_SESSION['user_name'].", I’ve worked hard to complete the writing of ".$_SESSION['song_title'].", just as you envisioned. Notes of ".$style[$_SESSION['song_style']]." music with lyrics that I hope will resonate with you. Here it is. Enjoy! Watch out, ".$_SESSION['user_name'].", I'm starting the machine now. Bye-bye.",
    "The next song is for you, ".$_SESSION['user_name']."! It's called: ".$_SESSION['song_title'].", and I wrote it as best as I could, but I was a bit rushed. Don’t hold it against me if it’s not great. Kisses, ".$_SESSION['user_name'].".",
    
    "I don’t mean to brag, but I think the next song is a stroke of genius! I wrote it for: ".$_SESSION['user_name']." and it's called: ".$_SESSION['song_title'].". Honestly, I think it’s pretty good. ".$_SESSION['user_name'].", get ready!",
    
    "Well, it wasn’t easy, but I’ve finally finished writing ".$_SESSION['song_title'].". Especially for ".$_SESSION['user_name'].". A song that's a bit ".$style[$_SESSION['song_style']].", which I hope will hit the mark. Let’s give it a listen."
);

?>
