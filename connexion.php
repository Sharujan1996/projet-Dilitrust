<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors',1);
//connexion à la base de données//
$bdd= new PDO('mysql:host=localhost;dbname=test','root','');
//si on remplit le formulaire avec un pseudo et un mot de passe existants alors l'utilisateur pourra accéder à l'accueil
if(isset($_POST['formconnexion'])){
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mdp = htmlspecialchars($_POST['mdp']);                    
    if(!empty($pseudo)AND !empty($mdp))
    {
        $requete =$bdd->prepare("SELECT * FROM utilisateur WHERE pseudo = ? AND  mdp = ?");
        $requete -> execute(array($pseudo,$mdp));
        $userexist = $requete -> rowCount();
        if($userexist==1){
           $userinfo =$requete -> fetch();
            $_SESSION['pseudo']= $userinfo['pseudo'];
            $_SESSION['mdp']= $userinfo['mdp'];
            header("Location:acceuil.php");
        }else{
            $erreur ="Mauvais login ou mdp";
        }
       
    }
    else
    {
        $erreur ="Tous les champs doivent être remplis";
    }
}
    ?>
<html>
    <head>
        <meta charset = "utf-8">
</head>
<body>
<div align="center">
    <h2> Connexion </h2>
    <br></br>
    <form method ="POST" action ="">
        <input type ="text" name ="pseudo" placeholder="saisir login"/>
        <input type ="password" name ="mdp" placeholder="saisir mot de passe"/>
        <input type ="submit"name="formconnexion" value="connexion"/>
</form>
<form method ="POST" action ="inscription.php">
<input type ="submit"name="inscription" value="inscription"/>
</form>
<?php 

    if(isset($erreur)){
        echo'<font color ="red">' .$erreur. "</font>";
    }
?>
</body>
</html>