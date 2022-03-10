<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors',1);
//connexion à la base de données//
$bdd= new PDO('mysql:host=localhost;dbname=test','root','');
echo isset($_SESSION['pseudo']);
$pseudo =$_SESSION['pseudo'];
$mdp = $_SESSION['mdp'];
$sql = "SELECT pseudo FROM utilisateur";
print_r("$pseudo <br>");
print_r("$mdp");
var_dump($mdp);
var_dump($pseudo);


try{
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
}

catch(Exception $ex){
  echo($ex -> getMessage());
}
// Requete SQL permettant de supprimer une ligne en fonction du pseudo selectionné//
if (isset($_POST['supprimer'])){
  $query = "DELETE FROM utilisateur WHERE pseudo =  '$pseudo' ";
  print($query);
  
  

  try{
    $stmp = $bdd->prepare($query);
    $stmp->execute();
    $results = $stmp->fetchAll();
    ?>
    <p> <?php echo $_SESSION['pseudo'] ?> a été supprimé</p>
<?php
}

catch(Exception $x){
  echo($x -> getMessage());
} 
  
}
?>
<head>
</head>
 <body>
 <center>
 <h2>Suppression</h2>
  <form method ="POST" action ="supprimerprofil.php">
   <label> liste login :
   <select name ="pseudo">
   <option> -- sélectionner login </option>
   <option><?php echo $_SESSION["pseudo"];?></option>
   </select>
   </label>
   <input type ="submit" onClick="if(!confirm('Voulez-vous supprimer ?'))return false;" name ="supprimer" value ="supprimer">
  </form>
<br>
  <form method ="POST" action ="acceuil.php">
   <input type ="submit" name ="retour" value="retour">
  </form>
  </center>
 </body>
</html>
