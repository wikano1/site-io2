<?php
  include_once("connexionmysql.php");
  $conn=connexion();
  $recherche = $_GET['recherche'];
  $rec='%'.$recherche.'%';
  $res = mysqli_query($conn,"SELECT * FROM contenu WHERE nom LIKE '$rec'");
  while ($row = mysqli_fetch_array($res)){
    $lien="<a href=moteur.php?".$row['1'];
    $resultat .= $lien.">".$row['1']."</a><br>";
  }
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>Resultat de la recherche</h1>
    <?php echo $resultat; ?>
  </body>
</html>
