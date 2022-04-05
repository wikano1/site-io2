<?php
  include_once("connexionmysql.php");
  $conn=connexion();
  $recherche = $_GET['recherche'];
  //cas 1 : note mais pas de nom
  if ($_GET['note/5']!='/'&&!isset($_GET['recherche'])) {
    $str = "SELECT * FROM contenu WHERE note ".$_GET['opérande']." ".$_GET['note/5'];
    $res = mysqli_query($conn, $str);
  }
  //cas 2 : nom mais pas de note
  if (isset($_GET['recherche']) && $_GET['note/5']=='/') {
    $rec='%'.$recherche.'%';
    $res = mysqli_query($conn,"SELECT * FROM contenu WHERE nom LIKE '$rec'");
  }
  //cas 3 : nom et note
  if (isset($_GET['recherche']) && $_GET['note/5']!='/') {
    $str = "note ".$_GET['opérande']." ".$_GET['note/5'];
    $rec='%'.$recherche.'%';
    $res = mysqli_query($conn,"SELECT * FROM contenu WHERE nom LIKE '$rec' AND ".$str);
  }
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
