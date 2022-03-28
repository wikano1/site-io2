<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>profil</title>
  </head>
  <body>
    <?php if($_SESSION['nom']!=null) {
            echo "<h1>Profil de ".$_SESSION['nom']."</h1>";
          } else {
            echo "vous n'êtes pas connecté";
          }
    ?>
    <br>
    <a href="accueil.php">Retournez à l'accueil</a>
  </body>
</html>
