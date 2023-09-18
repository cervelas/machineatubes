<?php

$humeur = array(
    "bossa"=>"tropicale",
    "pop"=>"pop",
    "16beat"=>"urbaine",
    "disco"=>"disco"
);

$texts_dedicace = array(
    "Bonjour ".$_SESSION['user_name']."! Je viens de finir les derniers réglages de la chanson ".$_SESSION['song_title']." que j’ai écrite rien que pour toi. On va partir sur une chanson ".$_SESSION['song_mood_name']." et un rythme ".$humeur[$_SESSION['song_style']].". J’espère que ça te plaira. Attention, c’est parti!",
    "Est-ce que ".$_SESSION['user_name']." est parmi nous? Super! J’ai le plaisir de te présenter ".$_SESSION['song_title']." composée spécialement pour toi! Une chanson aux couleurs ".$humeur[$_SESSION['song_style']]." qui, j’espère, collera à ton humeur ".$_SESSION['song_mood_name'].". Allez, on lance la machine!",
    "Et hop, encore un tube composé vite fait! Il s’appelle ".$_SESSION['song_title']." et a été écrit spécialement pour ".$_SESSION['user_name'].". J’ai essayé de coller à tes envies de chanson ".$humeur[$_SESSION['song_style']].", on écoute? C’est parti!",
    "Hello! Espérons, qu’il n’y ait pas de bug ce coup-ci. Si tout va bien, on va pouvoir écouter ".$_SESSION['song_title']." écrite sur les conseils de ".$_SESSION['user_name'].". C’est une belle chanson aux couleurs ".$_SESSION['song_mood_name'].", dans une ambiance ".$humeur[$_SESSION['song_style']].". Pif, paf pouf, allons-y.",
    "Hello! La prochaine chanson s’appelle ".$_SESSION['song_title']." et je l’ai composée pour ".$_SESSION['user_name']." qui semblait vouloir une chanson ".$_SESSION['song_mood_name']." sur des notes ".$humeur[$_SESSION['song_style']].". Voyons ce que ça donne, hahaha. Bisous ".$_SESSION['user_name'],
    "C’est bon, je suis prêt! ".$_SESSION['user_name'].", la prochaine est pour toi! Elle s’appelle ".$_SESSION['song_title']." et j’ai mélangé tes souhaits et mes inspirations, sur une musique ".$humeur[$_SESSION['song_style']].". Reste plus qu’à espérer que ça te plaise. 3, 2, 1 go!",
    "Cher ".$_SESSION['user_name'].", j’ai travaillé dur pour achever l’écriture de ".$_SESSION['song_title']." tel que tu l’as rêvé. Des notes ".$humeur[$_SESSION['song_style']]." sur un texte qui j’espère te parlera. Voilà. Bien du plaisir. Je lance la machine, salut.",
    "Salut salut, est-ce que ".$_SESSION['user_name']." est dans la salle? Je viens de finir l’écriture de ".$_SESSION['song_title'].", rien que pour toi! Je sais pas si c’est un tube, mais j’y ai mis tout mon coeur, tu verras c’est plutôt ".$humeur[$_SESSION['song_style']].". Attention, lancement de la machine!",
    "Coucou ".$_SESSION['user_name'].", j’ai le plaisir de te présenter ma dernière composition: ".$_SESSION['song_title'].", écrite juste pour toi. Une chanson ".$_SESSION['song_mood_name']." sur des rythmiques ".$humeur[$_SESSION['song_style']].". Y a plus qu’à espérer que ça te plaise. Amitiés.",
    $_SESSION['user_name']."! Cette chanson est pour toi! Elle s’appelle ".$_SESSION['song_title'].", et je l’ai écrite du mieux que j’ai pu, mais j’étais un peu à la bourre. Ne m’en veux pas si c’est nul. Bisous",
    "C’est pas pour me vanter, mais je pense que la prochaine chanson touche au génie! Je l’ai écrite pour ".$_SESSION['user_name']." et elle s’appelle ".$humeur[$_SESSION['song_style']].". Franchement, je crois que c’est pas mal. ".$_SESSION['user_name'].", accroche-toi!",
    "Bon, c’était pas facile, mais j’ai finalement terminé l’écriture de ".$_SESSION['song_title']." spécialement pour ".$_SESSION['user_name'].". Une chanson un peu ".$humeur[$_SESSION['song_style']]." qui j’espère saura faire mouche. Allez, on écoute."
);

?>
