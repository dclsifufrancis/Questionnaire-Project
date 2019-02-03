<?php 
// Est ce que des données ont été posté et que pseudo et password ne sont pas vide 
if(!empty($_POST) && !empty($_POST['pseudo']) && !empty($_POST['mdp'])) {

    // connexion à la bdd
    require_once 'include/db.php';

    // accès au functions
    require_once 'include/functions.php';

    // preparation d'une requete
                        // selectionne tout depuis la table users 
                                            // ou le pseudo = pseudo
                                                                        // ou si ça ne serait pas email
                                                                                                //et qui le confirmed at ne soit pas null
    $req = $pdo->prepare('SELECT * FROM membre WHERE (pseudo = :pseudo OR email = :pseudo) AND confirmed_at IS NOT NULL');


    // execute la requete dans un tableau associatif avec comme clé le pseudo
    $req->execute(['pseudo' => $_POST['pseudo']]);

    // je recupère le pseudo
    $membre = $req->fetch();

    if(password_verify($_POST['mdp'], $membre->mdp)) {

        session_start();

        $_SESSION['auth'] = $membre;

        $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
        
        header('Location: account.php');

        exit();

    }else{
        $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrect';
    }

}
?>



<?php require 'include/header.php'; ?>

    <h1>Se connecter</h1>

    <form action="" method="POST">
        <div class="form-group">
                <label for="" class="font-weight-bold">Pseudo ou email</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Votre pseudo ou email ...">
            </div>
            <div class="form-group">

            <div class="form-group">
                <label for="" class="font-weight-bold">Mot de passe</label>
                <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Votre mot de passe ..." >
            </div>

            <button type="submit" class="btn btn-primary">Se connecter</button>
            <div>
                <p>Vous n'êtes pas inscrit ?<a href="inscription.php"> Inscription</p>
            </div>
        </form>



<?php require 'include/footer.php'; ?>