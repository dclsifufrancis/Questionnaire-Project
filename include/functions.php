<?php
    // function nommé debut qui prend en paramètre la variable que je souhaite débugger
    function debug($variable) {
        echo '<pre>' . print_r($variable, true) . '</pre>';
    }

//fonction pour créer un token, chaine aléatoire à envoyer par mail pour confirmation d'inscription
function str_random($length) {
    //variable $alphabet contenant toute les lettres du clavier + chiffre
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPSDFGHJKLMWXCVBN";
                            //repéter la chaine de caractère 60 fois
                 //mélanger la chaine de caractère
        //je soustrait de cette chaines de caratère
                                                            // de 0 à 60                 
    return substr(str_shuffle(str_repeat($alphabet, $length)),0,$length);
}


function logged_only() {

    // si le statut de la session == Pas de session
  	if(session_status() == PHP_SESSION_NONE) {

    // alors on démare la sesion
        session_start();
    }

    // si l'utilisateur n'est pas connecté
    if(!isset($_SESSION['auth'])){
        // message d'erreur flash
        $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page, veuillez vous connercter";

        // redirection vers page de connexion
        header('Location: login.php');
        // pour empécher l'exécution du script
        exit();
    }
}