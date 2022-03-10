<?php
//error_reporting(E_ALL);
//ini_set('display_errors',1);
session_start();
//connexion à la base de données
$bdd= new PDO('mysql:host=localhost;dbname=test','root','');
// si on remplit le formulaire correctement alors l'utilisateur sera crée grace au INSERT INTO
if(isset($_POST['forcreation'])){
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];
    //echo "<pre>";
    print_r($_FILES);
    //echo "</pre>";
   
    

    
    ?>
    <p>Le login <?php echo $_POST['pseudo']; ?> existe deja</p>
    <?php
    if(!empty($pseudo) AND !empty($mdp)){
       $insertmbr = $bdd->prepare("INSERT INTO utilisateur(pseudo,mdp) VALUES(:pseudo,:mdp)");
       $userexist = $insertmbr -> rowCount();
       $bdd->beginTransaction();
       $insertmbr->execute (array(':pseudo'=>$pseudo,':mdp'=>$mdp));
       $bdd->commit();
       $bdd->null;
       $reussi = "j'ai reussi";
       $_SESSION['pseudo']=$pseudo;
       $_SESSION['mdp']=$mdp;
       
       header("Location:acceuil.php");
       
         } else
    {
        $erreur ="Tous les champs doivent être remplis";
    }
    

}

    

?>
<html>
<head>
<meta chartset= utf-8>
</head>
<body>
<center>
<h2> Création profil </h2>
<form  method="POST" action="" enctype ="multipart/form-data">
<input type ="text" name="pseudo" placeholder="login">
<br><br>
<input type ="password" name ="mdp" placeholder= "mot de passe">
<br><br>
<input type="submit" name="forcreation"  value="création">
</form>
<form  method="POST" action="connexion.php" enctype ="multipart/form-data">
<input type="submit" name="connexion"  value="connexion">
</form>
</center>
</body>
<?php 

    if(isset($erreur)){
        echo'<font color ="red">' .$erreur. "</font>";
    }
?>
</html>
