<?php require_once 'include/functions.php';

    session_start();

// si les champs sont différent de vide
if(!empty($_POST)){
    // alors errors
    // création de la variable errors qui est un tableau vide si pas d'erreur
    $errors= array();

    // alors connexion à la bdd 1 seule fois
    require_once 'include/db.php';

    // si champs pseudo est vide ou ne possède pas les caractère suivant
    if(empty($_POST['pseudo']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['pseudo'])){
        //alors errors sur champs pseudo
        $errors['pseudo'] = "Vous n'avez pas entrer de pseudo(ou il n'est pas alphanumérique)";
    } else {
        // prépare la requete de vérif si pseudo saisie déjà existant dans la bdd via ?
        $req = $pdo->prepare('SELECT id FROM membre WHERE pseudo = ?');
        // execute la requete avec un parametre tableau avec 1 seule paramètre "$_POST ['pseudo']"
        $req->execute([$_POST['pseudo']]);
        //récup de l'enregistrement
        $membre = $req->fetch();

        // si le peusdo existe déjà 
        if($membre){
            // alors erreur sur le champs username avec message d'erreur
            $errors['pseudo'] = "Ce pseudo est déjà pris !";
        }

    }



//création d'une fonction debug pour débugger les variables     
    // debug($errors);

    // si champs email est vide ou n'est pas au bon format via constante PHP filter_var et FILTER_VALIDATE_EMAIL
    if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        // alors errors
        $errors['email']= "Votre email n'est pas valide";
    } else {
        // prépare la requete de vérif si pseudo saisie déjà existant dans la bdd via ?
        $req = $pdo->prepare('SELECT id FROM membre WHERE email = ?');
        // execute la requete avec un parametre tableau avec 1 seule paramètre "$_POST ['pseudo']"
        $req->execute([$_POST['email']]);
        //récup de l'enregistrement
        $membre = $req->fetch();

        // si le peusdo existe déjà 
        if($membre){
            // alors erreur sur le champs username avec message d'erreur
            $errors['email'] = "Cet email est déjà utiliser pour un autre compte !";
        }
    }

    // debug($errors);

    //si champs mdp1 est vide ou si mdp1 est différent mdp2
    if(empty($_POST['mdp']) || $_POST['mdp'] != $_POST['mdp2']){
        // alors errors
        $errors = "Vos mots de passe sont différents ";
    }

    // si le tableau d'erreur est vide 
    if(empty($errors)) {
        
        // Variable "$req" qui stock la préparation via "?" pour inscrire l'utilisateur
        $req = $pdo->prepare("INSERT INTO membre SET pseudo = ?, email = ?, mdp = ?, confirmation_token = ?");

        // Cryptage mdp via methode intégrer à PHP "password_hash" puis l'algorithme à utiliser
        $mdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT);

        // création token avec un fonction chaine de caractère aléatoire de 60 caractère
        $token = str_random(60);

        // execution de la requete avec les 3 paramètre via $_POST
        $req->execute([$_POST['pseudo'], $_POST['email'], $mdp, $token]);

        // variable $user_id qui va récupérer le dernier user_id généré par PDO
        $membre_id = $pdo->lastInsertId();

        // création de variable pour envoi d'email 

        $to      = $_POST['email'];

        $subject = 'Confirmation de votre compte';

        $message = "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost/TRAVAIL/DEV/Questionnaire-Project/confirm.php?id=$membre_id&token=$token";

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .='From:webmaster@miniquizz.com'." ". "\r\n".
                    'Content-Type: text/plain; charset="utf-8"'."\r\n".
                    'Content-Transfer-Encoding: 8bit';

        // fonction mail avec les différents élément 
        mail($to, $subject, $message, $headers);
 

        $_SESSION['flash']['success'] = 'Un email de confirmation vous a été envoyé pour valider votre compte';


        // rediriger l'utilisateur vers la page de connexion
        header('Location:login.php');
        exit();
    }

    // debug($errors);

}
?>

<!-- header -->
<?php include('include/header.php');?>

    <div class="container">
        <div class="text-primary">
            <h1 class="text-center">Je m'inscris</h1>
        </div>


        <!-- message d'alerte en haut du formulaire   -->
        <!-- si les erreur son différent de champs vide -->
        <?php if(!empty($errors)): ?>
            <!-- création d'une div ROUGE -->
            <div class="alert alert-danger">
                <p>Vous n'avez pas rempli le formulaire correctement !</p>
                <ul>
                    <!-- affichage en forme de liste des différentes erreurs  -->
                    <?php foreach($errors as $error): ?>
                    <li>
                        <?= $error; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif;?>



        <form action="" method="POST">
        <div class="form-group">
                <label for="exampleInputEmail1" class="font-weight-bold">Pseudo</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Votre pseudo ...">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="font-weight-bold">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Votre email ..." >
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="font-weight-bold">Mot de passe</label>
                <input type="password" class="form-control" id="mdp"name="mdp" placeholder="Votre mot de passe ..." >
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="font-weight-bold">Confirmation de mot de passe</label>
                <input type="password" class="form-control" id="mdp2" name="mdp2" placeholder="Confirmez votre mot de passe ...">
            </div>
            <button type="submit" class="btn btn-primary">Je m'inscris</button>
        </form>
    </div>



<!-- footer -->
<?php include('include/footer.php');?>
