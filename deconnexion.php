<?php
//page permettant la deconnexion en lien avec le bouton présent dans l'accueil//
session_start();
session_destroy();
header('Location:connexion.php');
exit;
?>