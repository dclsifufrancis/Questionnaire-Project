<?php
//récupération des paramètres passé dans l'url
$membre_id = $_GET['id'];
$token = $_GET['token'];

// connection à la bdd
require 'include/db.php';

//préparation de la requete
$req = $pdo->prepare('SELECT * FROM membre WHERE id = ?');

//variable $req exécuter avec comme paramètre $user_id 
$req->execute([$membre_id]);

//je récupère l'info, 1 seule enregistrement donc on peut faire un fetch
$membre = $req->fetch();

// pour connecter l'utilisateur 
// démarrer la session
session_start();

// si le token et le même que celui passé en paramètre
if($membre && $membre->confirmation_token == $token){

    // req preparer et executé
    $pdo->prepare('UPDATE membre SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?')->execute([$membre_id]);

    // confirmation
    $_SESSION['flash']['success'] = " Votre compte à bien été validé";


    // super variable Session qui est conserver sur toute les pages
    // création de l'index 'auth' comme authentification et stocker l'utilisateur
    $_SESSION['auth'] = $membre;
    
    // redirection vers account.php
    header('Location: account.php');

}else{
    // message flash d'erreur
    $_SESSION['flash']['danger'] = "Ce token n'est plus valide";

    header('Location: login.php');
}