<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="style.css" rel="stylesheet" type="text/css" />
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
    <p>retournez à l'accueil<a href="index.php"> ici</a></p>


    <?php
include_once("connexionmysql.php");
$conn=connexion();
if(isset($_POST['nom'])) {
  if(isset($_POST['mdp'])) $bbb = htmlspecialchars($_POST['mdp']);
  $aaa = htmlspecialchars($_POST['nom']);
  if ($aaa=='' || $bbb =='') {
    echo 'mot de passe ou nom vide veuillez recommencer </div>';
  }
  elseif (strpos($aaa,' ')!=null || strpos($bbb,' ')!=null) {
    echo 'Espaces présents dans le nom ou le mot de passe veuillez recommencer</div>';
  } else {

    $mdpsec= sha1($_POST['mdp']);

    $res = mysqli_query($conn,"SELECT * FROM utilisateur WHERE nom = '$aaa'");
    $row = mysqli_fetch_array($res);
    if (mysqli_num_rows($res)==1) {
      echo "Nom d'utilisateur déjà existant, veuillez en choisir un autre";
    }
      else {
        $instruction = "INSERT INTO utilisateur(nom, motdepasse) VALUES ('$aaa', '$mdpsec')";
      }

      if(isset($instruction)) {
        if (mysqli_query($conn,$instruction)) echo "Compte crée</div>";
      }
  }
}
$conn->close();
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
