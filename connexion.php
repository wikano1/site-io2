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
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="style2.css" rel="stylesheet" type="text/css" />
    <title></title>
  </head>
  <body>
    <br><br>
  <div class="profil">
    <h3>Connectez-vous ci dessous</h3>
    <form action="connexion.php" method="POST">
    <p>Votre nom : <input type="text" name="nom"></p>
    <p>Votre mdp : <input type="text" name="mdp"></p>
    <p><input type="submit" value="OK"></p>
    <p>retournez à l'accueil<a href="accueil.php?page=1"> ici</a></p>

  <?php
    //vérification de si l'utilisateur a écrit dans le formulaire
    if(isset($a) && isset($b)) {
      //vérification de si les inputs sont vides ou non | non=else
      if(!empty($a) AND !empty($b)) {
        $verif = mysqli_query($conn,"SELECT * FROM utilisateur WHERE nom = '$a' AND motdepasse = '$bsec'");
        //vérification de si l'utilsateur et son mot de passe sont reconnus dans la BDD (en comptant les lignes renvoyées) | non=else
        if (mysqli_num_rows($verif)==1) {
          $_SESSION['nom'] = $a;
          header('Location: accueil.php?page=1');
          exit();
         } else {
            echo "Mauvais mail ou mot de passe !";
         }
      } else {
         echo "Tous les champs doivent être complétés !";
      }
    }
  ?>

  </body>
  <footer>
  <div class ="colonnes">
    <div class="colonne">
      <p>a propos</p>
    </div>
    <div class="colonne">
      <p>nos reseaux sociaux</p>
    </div>
    <div class="colonne">
      <p>aide</p>
     </div>
    <div class="colonne">
      <p>conditions d'utilistations</p>
    </div>
  </div>
</footer>
</div>
</html>
