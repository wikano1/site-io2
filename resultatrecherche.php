<?php
  include("index.php");
?>
<div class="moteur">
  <h1>Resultat de la recherche :</h1>
  <?php
    $recherche = htmlspecialchars($_GET['recherche']);
    $opérande = $_GET['opérande'];
    $note = $_GET['note/5'];
    //cas 1 : note mais pas de nom
    if ($_GET['note/5']!='/'&&!isset($_GET['recherche'])) {
      $str = "SELECT * FROM contenu WHERE note ".$opérande." ".$note;
      $res = mysqli_query($conn, $str);
    }
    //cas 2 : nom mais pas de note
    if (isset($_GET['recherche']) && $_GET['note/5']=='/') {
      $rec='%'.$recherche.'%';
      $res = mysqli_query($conn,"SELECT * FROM contenu WHERE nom LIKE '$rec'");
    }
    //cas 3 : nom et note
    if (isset($_GET['recherche']) && $_GET['note/5']!='/') {
      $str = "note ".$opérande." ".$note;
      $rec='%'.$recherche.'%';
      $res = mysqli_query($conn,"SELECT * FROM contenu WHERE nom LIKE '$rec' AND ".$str);
    }

    while ($row = mysqli_fetch_array($res)){
      $lien="<a href=moteur.php?".$row['1'];
      $resultat= $lien.">".$row['1']."</a><br>";
      echo $resultat;
    }
    ?>
</div>
