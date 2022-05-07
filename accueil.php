<?php
  include("index.php");
  $nbMoteursReq = mysqli_query($conn, "SELECT nom FROM contenu");
  $nbMoteurs = mysqli_num_rows($nbMoteursReq);
  if ($nbMoteurs%4!=0) {
    $maxPages = intval($nbMoteurs/4+1);
  } else {
    $maxPages = $nbMoteurs/4;
  }
  if ($nbMoteurs > 8) {
    $sup8 = true;
  } else {
    $sup8 = false;
  }
  echo '<div class="pages">';
  if ($_GET['page']!=1) {
    ?> <a href="accueil.php?page=<?php echo $_GET['page']-1; ?>"><?php echo $_GET['page']-1; ?></a>
  <?php }
     echo $_GET['page'];
     if ($_GET['page']!=$maxPages) {
    ?> <a href="accueil.php?page=<?php echo $_GET['page']+1; ?>"><?php echo $_GET['page']+1; ?></a>
  <?php }
  if ($_GET['page']+1!=$maxPages) {
    if ($_GET['page']!=$maxPages || ($_GET['page']==1 && $maxPages==3)) {
      ?> ... <a href="accueil.php?page=<?php echo $maxPages; ?>"><?php echo $maxPages; ?></a>
    <?php } ?>
  <?php }
  echo "</div>";
  $pageId=($_GET['page']-1)*4+1;
  $nbMoteursID = mysqli_query($conn, "SELECT nom FROM contenu");
  $nbMoteursId = mysqli_num_rows($nbMoteursID);
  $nbMoteursId = $nbMoteursId - $pageId;
  if ($nbMoteursId<4) {
    $nbMoteursId++;
  } else {
    $nbMoteursId = 4;
  }
  echo "<br>";
  $res = mysqli_query($conn,"SELECT * FROM contenu WHERE id>=$pageId");
  $moteursReq = mysqli_query($conn, "SELECT nom FROM contenu WHERE id>=$pageId");
  for ($i = 0; $i < $nbMoteursId; $i++) {
    $arrayMoteurs = mysqli_fetch_array($moteursReq);
    $row = mysqli_fetch_array($res);
    echo '<div class="images">';
    echo '<a href="moteur.php?'.$row['1'].'">'.$row['1']." :</a>";
    echo '<div class="description">';
    ?>
    <a href=moteur.php?<?php echo $arrayMoteurs['0'];?>><img alt="img" src="./test/<?php echo $arrayMoteurs['0'];?>.png"></a>
    <?php
    echo  '<a>Description :'.$row['5']."</a>";
    echo "</div>";
    echo "</div>";
    ?>
    <br><br><br>
    <?php
  }
  
?>
<br><br><br><br><br><br>