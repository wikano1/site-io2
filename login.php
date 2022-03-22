<?php
  include_once("connexionmysql.php");

  $conn=connexion();

  function verification($nom, $mdp) {
    $instruction="SELECT nom,motdepasse FROM utilisateur WHERE nom=".$nom;
    if(mysqli_query($conn,$instruction)) {
      echo "true";
    } else {
      echo "false";
    }
  }
  $conn->close();
 ?>
 <!DOCTYPE html>
 <html lang="fr" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
     <?php echo verification("alors", "peut etre"); ?>
   </body>
 </html>
