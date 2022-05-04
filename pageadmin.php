<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
  //Connexion à la base de données
  session_start();
  include_once("connexionmysql.php");
  $conn = connexion();
  //
  // Vérification de si l'utilisateur est admin ou non sinon renvoie sur erreur.html
  $user = $_SESSION['nom'];
  $a = mysqli_query($conn, "SELECT * FROM administrateur WHERE personne='$user'");
  $e = mysqli_fetch_array($a);
  if (strcmp($e['0'], $user)==0) {
  //
    ?><h1>Page administrateurs</h1><?php
    //affiche les notes et permet de les supprimer en cliquant sur l'image
    $res = mysqli_query($conn,"SELECT * FROM notes");
    ?><h2>Notes :</h2><?php
    //while qui s'arrête après avoir affiché toutes les notes
    while ($row = mysqli_fetch_array($res)) {
      //id du moteur de recherche ayant été noté
      $idnote = $row['0'];
      //l'utilisateur ayant posté la note
      $utilisateur = $row['1'];
      //récupère le nom du moteur de recherche
      $req = mysqli_query($conn,"SELECT nom FROM contenu WHERE id = '$idnote'");
      $contenu = mysqli_fetch_array($req);
      //
      //formulaire permettant de supprimer les notes : affiche Utilisateur: $nom, $nomdumoteur : $note
      ?><form action="suppression.php" method="post">
        <input type="hidden" name="bool" value="1">
        <input type="hidden" name="idnote" value="<?php echo $idnote; ?>">
        <p>Utilisateur: <?php echo $row['1']; ?>, <?php echo $contenu['0']; ?> : <?php echo $row['2'];?> <input type="image" src="woofwoof.png" width="32" height="27"alt="Submit"><input type="hidden" name="supprimer" value="<?php echo $utilisateur;?>"></p>
      </form><?php
    }
    //sélectionne tous les utilisateurs
    $res2 = mysqli_query($conn,"SELECT * FROM utilisateur");
    ?><h2>Utilisateurs :</h2><?php
    //while qui s'arrête après avoir affiché tous les utilisateurs
    while ($row = mysqli_fetch_array($res2)) {
      //nom de l'utilisateur
      $nomuser = $row['1'];
      //sélectionne les administrateurs pour ne pas les supprimer
      $req=mysqli_query($conn, "SELECT personne FROM administrateur WHERE personne='$nomuser'");
      $res=mysqli_num_rows($req);
      if($res==0) {
        //formulaire permettant de supprimer les utilisateurs : affiche Utilisateur: $nom
        ?><form action="suppression.php" method="post">
          <input type="hidden" name="bool" value="1">
          <p>Utilisateur: <?php echo $nomuser;?> <input type="image" src="woofwoof.png" width="32" height="27"alt="Submit"><input type="hidden" name="multisuppr" value="<?php echo $nomuser; ?>"></p>
        </form><?php
      }
    }
    //sélectionne les avis signalés
    $res3 = mysqli_query($conn, "SELECT * FROM notes WHERE report = true");
    ?><h2>Report :</h2><?php
    while ($row = mysqli_fetch_array($res3)) {
      $id = $row['0'];
      $req = mysqli_query($conn, "SELECT nom FROM contenu WHERE id = '$id'");
      //récupère le nom du moteur
      $contenu = mysqli_fetch_array($req);
      //affiche les avis signalés : Utilisateur: $nom, $nomdumoteur, avis : « "$avis" », note : $note
      echo "Utilisateur: ".$row['1'].", ".$contenu['0'].", avis: « ".$row['0']." », note : ".$row['2'];
    }
    //formulaire permettant d'ajouter des moteurs
    ?><h2>ajout de moteurs</h2>
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
      <p>Retournez à l'accueil <a href="accueil.php">ici</a></p>
    </body>
  </html>
