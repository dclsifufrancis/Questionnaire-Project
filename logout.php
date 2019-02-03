<?php
//démarre la session
session_start();

// supprime la partie d'authenfication
unset($_SESSION['auth']);

// message flash pour confirmer la deconnexion
$_SESSION['flash']['success'] = 'Vous êtes maintenant déconnecté';

header('Location: login.php');

?>
