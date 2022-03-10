<?php

session_start();
// si bouton présent ,cliquer dessus pour une redirection vers la page de parametrage//
error_reporting(E_ALL);
ini_set('display_errors',1);
//connexion à la base de données//
$bdd= new PDO('mysql:host=localhost;dbname=test','root','');

$pseudo = filter_var($_SESSION['pseudo'], FILTER_SANITIZE_STRING);
//requete SQL correspondant à la présence du bouton en fonction des accés de l'utilisateur connecté//
$m = $bdd->prepare("SELECT pseudo ,mdp FROM utilisateur WHERE pseudo = '" . $pseudo . "'");
$m->execute(array());
$user = $m->fetch(PDO::FETCH_ASSOC);



?>
<html>
     <head>
          <title>Accueil</title>
     </head>
          <body>
              <center>
               <div class ="container">
                    <h1> Accueil </h1>
                    <p> Bonjour <?php echo $_SESSION['pseudo'] ?></p>
                    <form method ="POST" action="supprimerprofil.php">
                    
                         <input type="submit" value="supprimer" name="supprimer" >
                         <br><br>
                         </form>
                     <form method="POST" action="modifierprofil.php">
                         <input type ="submit" value ="modifier" name="modifier">
                         </form>
                         <br><br>
                         <form method="POST" action="gestiondocument.php">
                         <input type ="submit" value="gestiondocument" name="gestiondocument" >
                         </form>
                         <br><br>

                    <a href="deconnexion.php"> Déconnexion </a>
                    </div>
               </body>
               <?php
                    if(isset($erreur)){
                              echo'<font color ="red">' .$erreur. "</font>";
                    }
                    ?>
              </center>
  </html>