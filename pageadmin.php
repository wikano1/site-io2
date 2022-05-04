<?php
  session_start();
  include_once("connexionmysql.php");
  $conn = connexion();
  $user = $_SESSION['nom'];
  $a = mysqli_query($conn, "SELECT * FROM administrateur WHERE personne='$user'");
  $e = mysqli_fetch_array($a);
  if (strcmp($e['0'], $user)==0) {
    echo '<div class="admin"><h1> Page administrateurs</h1>';
    $res = mysqli_query($conn,"SELECT * FROM notes");
    echo "<h2>Notes :</h2>";
    while ($row = mysqli_fetch_array($res)) {
      $idnote = $row['0'];
      $utilisateur = $row['1'];
      $req = mysqli_query($conn,"SELECT nom FROM contenu WHERE id = '$idnote'");
      $contenu = mysqli_fetch_array($req);
      echo "<form action=\"suppression.php\" method=\"post\">";
      echo "<input type=\"hidden\" name=\"bool\" value=\"1\">";
      echo "<input type=\"hidden\" name=\"idnote\" value=\"$idnote\">";
      echo "Utilisateur: ".$row['1'].", ".$contenu['0']." : ".$row['2']."  "."<input type=\"image\" src=\"woofwoof.png\" width=\"32\" height=\"27\"alt=\"Submit\">"."<input type=\"hidden\" name=\"supprimer\" value=\"$utilisateur\">";
      echo "</form>";
    }
    $res2 = mysqli_query($conn,"SELECT * FROM utilisateur");
    echo "<br><h2>Utilisateurs :</h2>";
    while ($row = mysqli_fetch_array($res2)) {
      $nomuser = $row['1'];
      $req=mysqli_query($conn, "SELECT personne FROM administrateur WHERE personne='$nomuser'");
      $res=mysqli_num_rows($req);
      if($res==0) {
        echo "<form action=\"suppression.php\" method=\"post\">";
        echo "<input type=\"hidden\" name=\"bool\" value=\"1\">";
        echo "Utilisateur: ".$nomuser." <input type=\"image\" src=\"woofwoof.png\" width=\"32\" height=\"27\"alt=\"Submit\">"."<input type=\"hidden\" name=\"multisuppr\" value=\"$nomuser\">";
        echo "</form>";
      }
    }
    $res3 = mysqli_query($conn, "SELECT * FROM notes WHERE report = true");
    ?><h2>Report :</h2><?php
    while ($row = mysqli_fetch_array($res3)) {
      $id = $row['0'];
      $req = mysqli_query($conn, "SELECT nom FROM contenu WHERE id = '$id'");
      $contenu = mysqli_fetch_array($req);
      $nomuser = $row['1'];
      $avis = $row['3'];
      $note = $row['2'];
      echo "<p>Utilisateur: ".$row['1'].", ".$contenu['0'].", avis: « ".$row['0']." », note : ".$row['2']."</p> ";
    }
    ?><h2>Ajout de moteurs :</h2>
    <form action="ajout.php" method="post" enctype="multipart/form-data">
      <label for="nom">nom : </label>
      <input type="text" name="nom">
      <br><br>
      <label for="lien">lien : </label>
      <input type="text" name="lien">
      <br><br>
      <label for="desc">description :</label>
      <input type="text" name="desc">
      <br><br>
      <input type="file" name="photo">
      <br><br>
      <input type="submit" value="envoyer">
    </form>
    <?php
  } else {
    header("Location: erreur.html");
    exit();
  }
  ?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <link href="style.css" rel="stylesheet" type="text/css" />
      <title></title>
    </head>
    <body>
      <p>Retournez à l'accueil <a href="index.php">ici</a></p>
</div>
      <br><br><br><br><br><br>
    </body>
    <footer>
  <div class ="colonnes">
    <div class="colonne"> 
      <p>a propos</p>
    </div>
    <div class="colonne"> 
      <p>nos reseaux sociaux</p>
    </div>
    <div class="colonne">
      <p>aide</p>
     </div>
    <div class="colonne"> 
      <p>conditions d'utilistations</p>
    </div>
  </div>
</footer>
  </html>
