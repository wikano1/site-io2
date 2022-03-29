<?php
  session_start();
  include_once("connexionmysql.php");
  $conn=connexion();
  $contenu = parse_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", PHP_URL_QUERY);
  //vérification de si le moteur existe dans la base de données
  $req = mysqli_query($conn,"SELECT * FROM contenu WHERE nom = '$contenu'");
  if(mysqli_num_rows($req)==0) {
    header('Location: erreur.html');
    exit();
  }
  $row = mysqli_fetch_array($req);
  $user=$_SESSION['nom'];
  $rowid = $row['0'];
  ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1><?php echo $contenu; ?></h1>
    <p>note : <?php echo $row['2'];?></p>
    <?php
    $res2 = mysqli_query($conn,"SELECT * FROM notes WHERE personne = '$user' AND id= '$rowid'");
    $row2 = mysqli_fetch_array($res2);
    if($row['0']==$row2['0']) {
      $b = 'false';
    } else {
      $b = 'true';
    }
    echo "<br>";
    echo $b;
    echo $row2['0'];
    echo "<br>";
    if ($b=='true') {
      $a = "<p>entrez une note ci-dessous:</p>
      <form action=\"note.php\" method=\"post\">
      <input type=\"hidden\" name=\"argh\" value=\"$contenu\">
      <input type=\"radio\" name=\"notation\" value=\"1\">
      <label for=\"1\">1</label>
      <input type=\"radio\" name=\"notation\" value=\"2\">
      <label for=\"2\">2</label>
      <input type=\"radio\" name=\"notation\" value=\"3\">
      <label for=\"3\">3</label>
      <input type=\"radio\" name=\"notation\" value=\"4\">
      <label for=\"4\">4</label>
      <input type=\"radio\" name=\"notation\" value=\"5\">
      <label for=\"5\">5</label>
      <br>
      <input type=\"submit\" name=\"Submit\">
      </form>";
      echo $a;
    }
    ?>
  </body>
</html>
