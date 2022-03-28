<?php
  include_once("connexionmysql.php");
  $conn=connexion();
  $contenu = parse_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", PHP_URL_QUERY);
  $req = mysqli_query($conn,"SELECT note FROM contenu WHERE nom = '$contenu'");
  $row = mysqli_fetch_array($req);
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1><?php echo $contenu; ?></h1>
    <p>note : <?php echo $row['0'];?></p>
  </body>
</html>
