<?php
  session_start();
  include_once("connexionmysql.php");
  $conn = connexion();
  $user =$_SESSION['nom'];
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>profil</title>
  </head>
  <body>
    <?php if($user!=null) {
            echo "<h1>Profil de ".$user."</h1>";
            $res = mysqli_query($conn,"SELECT * FROM notes WHERE personne = '$user'");
            echo "<p>Notes :</p>";
            while ($row = mysqli_fetch_array($res)) {
              $idnote = $row['0'];
              $req = mysqli_query($conn,"SELECT nom FROM contenu WHERE id = '$idnote'");
              $contenu = mysqli_fetch_array($req);
              echo "<form action=\"suppression.php\" method=\"post\">";
              echo $contenu['0']." : ".$row['2']."  "."<input type=\"image\" src=\"woofwoof.png\" width=\"32\" height=\"27\"alt=\"Submit\">"."<input type=\"hidden\" name=\"supprimer2\" value=\"$idnote\">";
              echo "</form>";
            }
          } else {
            echo "vous n'êtes pas connecté";
          }
    ?>
    <br>
    <a href="accueil.php">Retournez à l'accueil</a>
  </body>
</html>
