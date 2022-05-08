<?php
  //import de l'index
  include("index.php");
  session_start();

  //calcule le nombre maximal de pages
  $nbMoteursReq = mysqli_query($conn, "SELECT nom FROM contenu");
  $nbMoteurs = mysqli_num_rows($nbMoteursReq);
  if ($nbMoteurs%4!=0) {
    $maxPages = intval($nbMoteurs/4+1);
  } else {
    $maxPages = $nbMoteurs/4;
  }


  //calcule le nombre de moteurs à afficher dans la page courante
  $pageId=($_GET['page']-1)*4+1;
  $nbMoteursID = mysqli_query($conn, "SELECT nom FROM contenu");
  $nbMoteursId = mysqli_num_rows($nbMoteursID);
  $nbMoteursId = $nbMoteursId - $pageId;
  if ($nbMoteursId<4) {
    $nbMoteursId++;
  } else {
    $nbMoteursId = 4;
  }

  //récupère les moteurs à afficher
  $toutMoteursReq = mysqli_query($conn,"SELECT * FROM contenu WHERE id>=$pageId");
  $moteursReq = mysqli_query($conn, "SELECT nom FROM contenu WHERE id>=$pageId");

?>



  <!-- partie html -->
<div class="pages">
    <?php
      if ($_GET['page']!=1) {
    ?>
        <a href="accueil.php?page=<?php echo $_GET['page']-1; ?>"><?php echo $_GET['page']-1; ?></a>
    <?php
      }
      echo $_GET['page'];
      if ($_GET['page']!=$maxPages) {
    ?>
        <a href="accueil.php?page=<?php echo $_GET['page']+1; ?>"><?php echo $_GET['page']+1; ?></a>
    <?php
      }
      if ($_GET['page']+1!=$maxPages) {
        if ($_GET['page']!=$maxPages || ($_GET['page']==1 && $maxPages==3)) {
    ?>
        ... <a href="accueil.php?page=<?php echo $maxPages; ?>"><?php echo $maxPages; ?></a>
    <?php
        }
      }
    ?>
</div>
<br>
<?php
  for ($i = 0; $i < $nbMoteursId; $i++) {
    $arrayMoteurs = mysqli_fetch_array($moteursReq);
    $row = mysqli_fetch_array($toutMoteursReq);
?>
    <div class="images">
      <a href="moteur.php?<?php echo $row['1']; ?>"><?php echo $row['1']; ?></a>
      <div class="description">
        <a href=moteur.php?<?php echo $arrayMoteurs['0'];?>><img alt="img" src="./test/<?php echo $arrayMoteurs['0'];?>.png"></a>
        <p>Description :<?php echo $row['5']; ?></p>
      </div>
    </div>
    <br><br><br>
<?php
  }
?>
<br><br><br><br><br><br>
