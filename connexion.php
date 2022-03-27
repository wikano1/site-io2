<?php
 include_once("connexionmysql.php");
 $conn=connexion();
 session_start();
 $a=$_POST['nom'];
 $b=$_POST['mdp'];
 echo $_SESSION['nom'];
 if(!empty($a) AND !empty($b)) {
   $res = mysqli_query($conn,"SELECT * FROM utilisateur WHERE nom = '$a' AND motdepasse = '$b'");
   if (mysqli_num_rows($res)==1) {
     $_SESSION['nom'] = $_POST['nom'];
    } else {
       echo "Mauvais mail ou mot de passe !";
    }
 } else {
    echo "Tous les champs doivent être complétés !";
 }
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>connectez-vous ci dessous</h1>
    <form action="connexion.php" method="POST">
    <p>Votre nom : <input type="text" name="nom"></p>
    <p>Votre mdp : <input type="text" name="mdp"></p>
    <p><input type="submit" value="OK"></p>
  </body>
</html>
