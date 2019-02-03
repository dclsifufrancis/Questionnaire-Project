<?php
    if(session_status() == PHP_SESSION_NONE) {
    session_start();
    }
?>

<!doctype html>
<html lang="fr">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./CSS/bootstrap.min.css">
    <title>Mini-Quizz</title>
    </head>
    <body>
    

    <!-- NAVBAR-->

    <nav class="navbar navbar-dark bg-primary">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

        <form class="bd-search d-flex align-items-center">
            <input type="search" class="form-control" id="search-input" placeholder="Search..." aria-label="Search for..." autocomplete="off">
        </form>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="account.php">Mon profil</a>
                </li>
                <!-- s'il y a une clé "auth" dans la session -->
                <?php if (isset($_SESSION['auth'])):?>

                    <!-- alors afficher un bouton de deconnexion avec un lien vers la page de déconnexion -->
                    <li class="nav-item active">
                    <a class="nav-link" href="logout.php">Se déconnecter</a></li>

                <!-- ou alors -->
                <?php else: ?>
			
                    <li class="nav-item"><a class="nav-link" href="login.php">Connexion / Inscription</a></li>

                <?php endif; ?>

            </ul>
        </div>
        
    </nav>



    <div class="container">
    	  <!-- Est ce que j'ai quelque chose dans la clé flash -->
	    <?php if(isset($_SESSION['flash'])): ?>

        <!-- si oui alors je parcours la clé flash via foreach 
                                        et je récupère en clé le type 
                                                    et je recupère en valeur le message -->
        <?php foreach($_SESSION['flash'] as $type => $message):?>

        <!-- Création div alerte avec le type -->
        <div class="alert alert-<?=$type; ?>">
                <!-- affiche le message d''erreur' -->
                <?= $message; ?>
            </div>

        <?php endforeach; ?>
        <!-- destruction du message flash -->
        <?php unset($_SESSION['flash']); ?>

        <?php endif; ?>