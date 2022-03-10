<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors',1);
//connexion à la base de données//
$bdd= new PDO('mysql:host=localhost;dbname=test','root','');
$ps = $_POST['pseudo'];
$md= $_POST['mdp'];
var_dump($ps);
var_dump($md);


  $m = $bdd->prepare("SELECT pseudo ,mdp FROM utilisateur WHERE pseudo = ?");
  $m->execute(array($ps));
  $user = $m->fetch(PDO::FETCH_ASSOC);
  //var_dump($user);
  $pseudo = $user['pseudo'];
  $mdp = $user['mdp'];

  //print_r($m);
  var_dump("$pseudo");
  var_dump("$mdp");



// On fait un update pour permettre de modifier les données , la modification sera enregistrée dans la BD , pseudo est le seul attribut non modifiable
if(isset($_POST['valider'])){
    $p = "UPDATE utilisateur SET mdp= '$md' WHERE pseudo ='$pseudo'";

   //echo $p;

  
    try{
      $stpp = $bdd->prepare($p);
      $stpp->execute();
      $results = $stpp->fetch();
  }
  
  catch(Exception $ex){
    echo($ex -> getMessage());
  }
}

?>
</head>
<body>
<div align="center">
    <h2> Modification profil </h2>
    <br></br>
    <form name = "f3" method ="POST" action ="" enctype ="multipart/form-data">
    <input type ="text" name ="pseudo" value ="<?php echo $_SESSION['pseudo']; ?> "/><br><br>
        <input type ="password" name ="mdp" value ="<?php echo $_SESSION['mdp']; ?> " /><br><br>
        <input type ="submit" name="valider" value="valider" onClick ="f3.action = 'modifierprofil.php'; return true; "/>   
     </form>
     <form method="POST" action="acceuil.php">
     <input type="submit" value="retour"/>
     </form>
     </body>
     </html>