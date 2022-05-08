<?php
  //Connexion à la base de données
  session_start();
  include_once("connexionmysql.php");
  $conn = connexion();
  $user = $_SESSION['nom'];
  // Vérification de si l'utilisateur est admin ou non sinon renvoie sur erreur.html

  $a = mysqli_query($conn, "SELECT * FROM administrateur WHERE personne='$user'");
  $e = mysqli_fetch_array($a);

  $res = mysqli_query($conn,"SELECT * FROM notes");


  if (strcmp($e['0'], $user)==0) {
?>
  <div class="admin">
    <h1>Page administrateurs</h1>
    <h2>Notes :</h2>

      <?php
      //affiche les notes et permet de les supprimer en cliquant sur l'image

        while ($row = mysqli_fetch_array($res)) {
          $idnote = $row['0'];
          $utilisateur = $row['1'];
          $req = mysqli_query($conn,"SELECT nom FROM contenu WHERE id = '$idnote'");
          $contenu = mysqli_fetch_array($req);
      ?>

      <form action="suppression.php" method="post">
        <input type="hidden" name="bool" value="1">
        <input type="hidden" name="idnote" value="<?php echo $idnote;  ?>">
        <p>
          Utilisateur: <?php echo $row['1']; ?>, <?php echo $contenu['0']; ?> : <?php echo $row['2']; ?>
          <input type="image" src="croix.png" width="32" height="27"alt="Submit">
        </p>
        <input type="hidden" name="supprimer" value="<?php echo $utilisateur; ?>">
      </form>
    <?php
      }
      $res2 = mysqli_query($conn,"SELECT * FROM utilisateur");
    ?>
    <br><h2>Utilisateurs :</h2>
    <?php
      while ($row = mysqli_fetch_array($res2)) {
        $nomuser = $row['1'];
        $req=mysqli_query($conn, "SELECT personne FROM administrateur WHERE personne='$nomuser'");
        $res=mysqli_num_rows($req);
        if($res==0) {
    ?>
          <!--       //formulaire permettant de supprimer les notes : affiche Utilisateur: $nom, $nomdumoteur : $note
-->
          <form action="suppression.php" method="post">
            <input type="hidden" name="bool" value="1">
            <p>
              Utilisateur: <?php echo $nomuser; ?>
              <input type="image" src="croix.png" width="32" height="27"alt="Submit">
            </p>
            <input type="hidden" name="multisuppr" value="<?php echo $nomuser; ?>">
          </form>
    <?php
        }
      }
      $res3 = mysqli_query($conn, "SELECT * FROM notes WHERE report = true");
    ?>
    <h2>Report :</h2>
    <?php
      while ($row = mysqli_fetch_array($res3)) {
        $id = $row['0'];
        $req = mysqli_query($conn, "SELECT nom FROM contenu WHERE id = '$id'");
        $contenu = mysqli_fetch_array($req);
    ?>
        <p>Utilisateur: <?php echo $row['1'];?>, <?php echo $contenu['0']; ?>, avis: « <?php echo $row['3']; ?> », note : <?php echo $row['2']; ?></p>
    <?php
      }
    ?>
    <h2>Ajout de moteurs :</h2>
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
      <link href="style2.css" rel="stylesheet" type="text/css" />
      <title></title>
    </head>
    <body>
      <p>Retournez à l'accueil <a href="accueil.php?page=1">ici</a></p>
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
