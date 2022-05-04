<?php
include_once("connexionmysql.php");

$conn=connexion();
$aaa = htmlspecialchars($_POST['nom']);
$bbb = htmlspecialchars($_POST['mdp']);

$mdpsec= sha1($_POST['mdp']);

//vérifie que l'utilisateur n'existe pas déjà
$res = mysqli_query($conn,"SELECT * FROM utilisateur WHERE nom = '$aaa'");
$row = mysqli_fetch_array($res);
if (mysqli_num_rows($res)==1) {
  echo "nom d'utilisateur déjà existant, veuillez en choisir un autre";
}
else if ($aaa=='' || $bbb =='') {
  echo 'mot de passe ou nom vide';
}
elseif (strpos($aaa, ' ')!==null || strpos($bbb, ' ')!==null) {
  echo 'espaces présents dans le nom ou le mot de passe';
}
else {
//ajoute l'utilisateur
$instruction = "INSERT INTO utilisateur(nom, motdepasse) VALUES ('$aaa', '$mdpsec')";

if (mysqli_query($conn,$instruction)) echo "compte créé";
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
     <p>veuillez retourner à l'accueil en cliquant <br><a href=accueil.php>ici</a></p>
  </body>
</html>
