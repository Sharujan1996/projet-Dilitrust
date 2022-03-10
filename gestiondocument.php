<?php 
$bdd= new PDO('mysql:host=localhost;dbname=test','root','');
//var_dump($_FILES);
if(!empty($_FILES)){
    $file_name =$_FILES['fichier']['name'];
    $file_extension = strrchr($file_name,".");
    $file_tmp_name = $_FILES['fichier']['tmp_name'];
    $file_dest = 'C:\xampp\htdocs\files\ '.$file_name;
    var_dump($file_tmp_name);
    var_dump($file_dest);
    $extension_autorisee = array('.pdf','.PDF');

    if(in_array($file_extension, $extension_autorisee)){
        if(move_uploaded_file($file_tmp_name,$file_dest)){
            $insertmbr = $bdd->prepare("INSERT INTO document(nom,url) VALUES(?,?)");
            $insertmbr->execute(array($file_name,$file_dest));
            echo 'le fichier est bien envoyé';
        }else{
            echo "Echec de l'envoi";
        }
   }else{
       echo 'PDF seulement autorisés';
   }
}
?>
<head>
<title> Telechargement de fichier </title>
</head>
 <body>
 <h1>Uploader un fichier</h1>
 <form enctype="multipart/form-data" method="POST">
 <input type="file" name="fichier">
 <input type="submit" value="Envoyer"/>
 </form>
 <h1> Fichiers enregistrés </h1>
 <?php
   $sql = $bdd->query("SELECT nom, url FROM document");
   while($data = $sql->fetch()){
       echo $data['nom'].' : '.'<a href="'.$data['url'].'">Telecharger '.$data['nom'].'</a><br>';
   }
   ?>
   <h1> Supprimer fichier d'un dossier </h1>
   <form action ="" method="POST">
     <input type="text" name="fichier">
     <input type="submit" name="submit" value ="supprimer">
     </form>

    <?php
    $fichier = $_POST['fichier'];
    if (isset($_POST['submit'])){
        $query = "DELETE FROM document WHERE nom =  '$fichier' ";
        print($query);
        
        
      
        try{
          $stmp = $bdd->prepare($query);
          $stmp->execute();
          $results = $stmp->fetchAll();
        }
        catch(Exception $x){
            echo($x -> getMessage());
          } 
            
        if(isset($_POST['fichier'])){
            unlink('C:\xampp\htdocs\files\ '.$fichier);
            echo "le fichier sera supprimé";
            
        }
    }
        ?>
 </body>