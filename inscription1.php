<?php
  include_once("connexionmysql.php");
  $conn=connexion();
  $bool = false;
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="style2.css" rel="stylesheet" type="text/css" />
    <title>inscription</title>
  </head>
  <body>
    <br>
    <br>
    <div class="profil">
    <h3>Vous pouvez vous inscrire via le formulaire ci dessous :</h3>
    <form action="inscription1.php" method="POST">
    <p>Votre nom <a>* </a> : <input type="text" name="nom"></p>
    <p>Votre mdp <a>* </a> : <input type="text" name="mdp"></p>
    <p><input type="submit" value="inscription"></p>
    <p>retournez à l'accueil<a href="accueil.php?page=1"> ici</a></p>
    <?php

      if(isset($_POST['nom']) && isset($_POST['mdp'])) {
        $aaa = htmlspecialchars($_POST['nom']);
        $bbb = htmlspecialchars($_POST['mdp']);

    if(isset($aaa) && isset($bbb)) {
      if ($aaa=='' || $bbb =='') {
      echo 'mot de passe ou nom vide veuillez recommencer </div>';
      }


      elseif (strlen($aaa)>16 || strlen($bbb)>16) {
        echo "nom ou mdp supérieur à 16 caractères </div>";
      }

      else {
        for ($i = 0; $i<strlen($aaa); $i++) {
          if ($aaa[$i]==' ') {
            $bool = true;
          }
        }
        for ($i = 0; $i<strlen($bbb); $i++) {
          if ($bbb[$i]==' ') {
            $bool = true;
          }
        }
      }

      if ($bool==true) {
      echo 'Espaces présents dans le nom ou le mot de passe veuillez recommencer</div>';
      }

      else {

      $mdpsec= sha1($_POST['mdp']);

      $res = mysqli_query($conn,"SELECT * FROM utilisateur WHERE nom = '$aaa'");
      $row = mysqli_fetch_array($res);

      }

      if (mysqli_num_rows($res)==1) {
        echo "Nom d'utilisateur déjà existant, veuillez en choisir un autre";
      }

      else {
        $instruction = "INSERT INTO utilisateur(nom, motdepasse) VALUES ('$aaa', '$mdpsec')";
      }

      if(isset($instruction)) {
        if (mysqli_query($conn,$instruction)) {
          echo "Compte crée</div>";
        }
      }
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
</html>
