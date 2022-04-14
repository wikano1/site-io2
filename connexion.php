<?php
 include_once("connexionmysql.php");
 $conn=connexion();
 session_start();
 //vérification de si l'utilisateur a écrit dans le formulaire ($nom) (nécessaire au non affichage d'un message d'erreur)
 if (isset($_POST['nom'])) {
   $a=htmlspecialchars($_POST['nom']);
   $b=htmlspecialchars($_POST['mdp']);
   $bsec = sha1($b);
 }
 //vérification de si l'utilisateur a écrit dans le formulaire
 if(isset($a) && isset($b)) {
   //vérification de si les inputs sont vides ou non | non=else
   if(!empty($a) AND !empty($b)) {
     $res = mysqli_query($conn,"SELECT * FROM utilisateur WHERE nom = '$a' AND motdepasse = '$bsec'");
     //vérification de si l'utilsateur et son mot de passe sont reconnus dans la BDD (en comptant les lignes renvoyées) | non=else
     if (mysqli_num_rows($res)==1) {
       $row = mysqli_fetch_array($res);
       $_SESSION['nom'] = $a;
       header('Location: accueil.php');
       exit();
      } else {
         echo "Mauvais mail ou mot de passe !";
      }
   } else {
      echo "Tous les champs doivent être complétés !";
   }
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
    <p>retournez à l'accueil<a href="accueil.php"> ici</a></p>
  </body>
</html>
