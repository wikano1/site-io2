<?php
  include("index.php");
  session_start();

  $contenu = parse_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", PHP_URL_QUERY);

  //vérification de si le moteur existe dans la base de données
  $req = mysqli_query($conn,"SELECT * FROM contenu WHERE nom = '$contenu'");

  if(mysqli_num_rows($req)==0) {
    header('Location: erreur.html');
    exit();
  }

  $row = mysqli_fetch_array($req);
  $rowid = $row['0'];

  if(isset($_SESSION['nom'])) {
    $user=$_SESSION['nom'];
  }

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title></title>
  </head>
  <body>
    <p><img src="test/<?php echo $contenu ?>.png" height="256"></p>
    <p><div class="moteur"> Note :
      <?php
        if ($row['2']!=0) {
          echo $row['2'];
        } else {
          echo "pas de note";
        }
      ?>
    </p>
    <p>Lien : <?php echo "<a href=".$row['3'].">Accéder au site </a>"?></p>
    <p>Description : <?php echo $row['5']; ?></p>
    <?php
    if(isset($user)) {
      $res2 = mysqli_query($conn,"SELECT * FROM notes WHERE personne = '$user' AND id= '$rowid'");
      $row2 = mysqli_fetch_array($res2);
      $b='true';
      if(isset($row2['0'])) {
        if($row['0']==$row2['0'] && isset($_SESSION['nom'])) {
          $b = 'false';
        }
        else {
          if (!isset($_SESSION['nom'])) {
            $b = 'false';
          }
          else {
            $b= 'true';
          }
        }
      }
    }
  if ($b=='true') { ?>
    <p>entrez une note ci-dessous:</p>
    <form action="note.php" method="post">
    <input type="hidden" name="argh" value="<?php echo $contenu; ?>">
    <input type="radio" name="notation" value="1">
    <label for="1">1</label>
    <input type="radio" name="notation" value="2">
    <label for="2">2</label>
    <input type="radio" name="notation" value="3">
    <label for="3">3</label>
    <input type="radio" name="notation" value="4">
    <label for="4">4</label>
    <input type="radio" name="notation" value="5">
    <label for="5">5</label>
    <br>
    <br>
    <label for="avis">Entrez votre avis ici:</label>
    <input type="text" name="avis" size="30" style="height:50px">
    <br>
    <br>
    <input type="submit" name="Submit">
    </form>
  <?php } ?>
    <p>Avis :</p>
    <?php
      $req1 = mysqli_query($conn, "SELECT id FROM contenu WHERE nom='$contenu'");
      $req1a = mysqli_fetch_array($req1);
      $idcontenu = $req1a['0'];
      $req = mysqli_query($conn, "SELECT avis,personne,note,report FROM notes WHERE id = '$idcontenu'");
      while($row = mysqli_fetch_array($req)) {
        if (!empty($row['0'])) {
          ?><form action="report.php" method="post"><?php
          if ($row['3']=='1') {
            ?><p>avis de <?php echo $row['1']; ?> : <?php echo $row['0']; ?> note: <?php echo $row['2']; ?></p><?php
          } else {
            ?><p>avis de <?php echo $row['1']; ?> : <?php echo $row['0']; ?> note: <?php echo $row['2']; ?>
              <input type="hidden" name="personne" value="<?php echo $row['1']; ?>">
              <input type="hidden" name="argh" value="<?php echo $contenu; ?>">
              <input type="hidden" name="id" value="<?php echo $rowid; ?>">
              <input type="image" src="croix.png" width="32" height="27" alt="Submit"></p>
          <?php }
        } else {
          ?>
          <p>avis de <?php echo $row['1']; ?> : sans commentaire, note: <?php echo $row['2']; ?></p>
    <?php
          }
      }
    ?>
    <p>Retournez à l'accueil <a href="accueil.php?page=1">ici</a></p>
    </div>
  </body>
  <br><br><br><br><br><br>
</html>
