<?php

require 'include/functions.php';

logged_only();

require 'include/header.php'; 

?>
    <h2 class="text-center"> Hello, <?=$_SESSION['auth']->pseudo ; ?> </h2>

<!-- <?php debug($_SESSION);?> -->

    <div class="alert alert-warning" role="alert">
        <a href="">Quiz à valider</a>
    </div>

    <div class="alert alert-warning" role="alert">
        <a href="quiz.php">Créer un Quiz</a>
    </div>




<?php
    if(session_status() == PHP_SESSION_ACTIVE) {

    }
?>


<?php
// création de la variable status 
        // récup la $_SESSION['auth']
                            // récup le statut 1=admin ou 2=membre pour vérif 
$status = $_SESSION['auth']->statut_membre_idstatut_membre;

// si session == statut 1 (admin)
if($_SESSION['auth'] && $status == 1){
    // alors on affiche
?>
    <div class="text-primary">
        <h2 class="text-center">Interface Administrateur</h2>
    </div>

    <div class="alert alert-success" role="alert">
        <a href="">Quiz à publier</a>
    </div>

    <div class="alert alert-dark" role="alert">
        <a href="">Quiz à archiver</a>
    </div>


<?php
}
?>








<?php require 'include/footer.php'; ?>
