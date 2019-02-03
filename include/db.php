

<?php
// création variable $contenu_json pour Récupérer le contenu du fichier db.json 
    $contenu_json = file_get_contents('db.json');
    
// création variable $db_Info décoder le contenu sous forme de tableau (true)
    $db_Info = json_decode($contenu_json, true);

    //connexion à la bdd
    try{
        $pdo = new PDO('mysql:host=' . $db_Info['hostname'] . ';dbname=' . $db_Info['db_name'], $db_Info['db_user'], $db_Info['db_password']);

        // ajout d'un attribut au PDO
                //accès à la base de constante via class PDO
                // je veux accéder à la constante ATTR_ERR_MODE qui se situe dans la classe PDO 
                                    //lorsqu'il y aura une erreur je veux que tu renvois une exception
                                    //via la constante ERRMODE_EXEPTION de la classe PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        // ajout d'un attribut au PDO
                // replacer ATTR_DEFAULT_FETCH_MODE par FETCH_OBJ via les constante de la classe PDO
        $pdo-> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        $pdo->exec("SET NAMES utf8");
        
    }
    catch (Exception $e) {
        die ('Erreur : ' . $e->getMessage());
    }
        
