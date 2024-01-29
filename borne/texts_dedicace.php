<?php

$humeur = array(
    "bossa"=>"tropicale",
    "pop"=>"pop",
    "16beat"=>"urbaine",
    "disco"=>"disco"
);

$texts_dedicace = array(
    "Et hop, encore un tube composé vite fé, bien fé! Il s’appelle: ".$_SESSION['song_title'].". Et il a été écrit spécialement pour: ".$_SESSION['user_name'].". J’ai essayé de coller à tes zenvies de chanson ".$humeur[$_SESSION['song_style']].", on écoute? C’est parti!",
    "Hello! Espérons, qu’il n’y ait pas de bug ce coup-ci. Si tout va bien, on va pouvoir écouter: ".$_SESSION['song_title'].". Elle a été écrite sur les conseils de: ".$_SESSION['user_name'].". C’est une belle chanson aux couleurs ".$_SESSION['song_style'].". Pif, paf pouf, allonzi.",
    "Hello! La prochaine chanson s’appelle: ".$_SESSION['song_title'].". Je l’ai composée pour: ".$_SESSION['user_name'].", qui semblait vouloir une chanson aux notes: ".$humeur[$_SESSION['song_style']].". Voyons ce que ça donne. Ha ha ha. Bisous ".$_SESSION['user_name'],
    "C’est bon, je suis prêt! Attention, ".$_SESSION['user_name'].", la prochaine est pour toi! Elle s’appelle: ".$_SESSION['song_title'].". Pour écrire cette belle chanson, j’ai mélangé tes souhaits et mes inspirations. Sur une musique: ".$humeur[$_SESSION['song_style']].". Reste plu qu’à espérer que ça te plaise. 3, 2, 1 go!",
    "Cher ".$_SESSION['user_name'].", j’ai travaillé dur pour achever l’écriture de ".$_SESSION['song_title'].", tel que tu l’a rêvé. Des notes ".$humeur[$_SESSION['song_style']]." sur un texte qui j’espère te parlera. Voilà. Bien du plaisir. Attention ".$_SESSION['user_name'].", je lance la machine, salut.",
    "La prochaine chanson est pour toi: ".$_SESSION['user_name']."! Elle s’appelle: ".$_SESSION['song_title'].", et je l’ai écrite du mieux que j’ai pu, mais j’étais un peu à la bourre. Ne m’en veux pas si c’est nul. Bisous ".$_SESSION['user_name'],
    "C’est pas pour me vanter, mais je pense que la prochaine chanson touche au génie! Je l’ai écrite pour: ".$_SESSION['user_name'].", et elle s’appelle: ".$_SESSION['song_title'].". Franchement, je crois que c’est pas mal. ".$_SESSION['user_name'].", accroche-toi!",
    "Bon, c’était pas facile, mais j’ai finalement terminé l’écriture de ".$_SESSION['song_title'].". Spécialement pour ".$_SESSION['user_name'].". Une chanson un peu ".$humeur[$_SESSION['song_style']]." qui j’espère saura faire mouche. Allez, on écoute."
);

?>
