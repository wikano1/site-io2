<?php
  include_once("connexionmysql.php");
  $conn=connexion();


  if(isset($_FILES['photo']) AND isset($_POST['nom']) AND isset($_POST['lien']) AND isset($_POST['desc'])) {


    $nom = htmlspecialchars($_POST['nom']);
    $lien = htmlspecialchars($_POST['lien']);
    $desc = htmlspecialchars($_POST['desc']);

    //problème de guillemets
    $desc = str_replace("'", "\'", $desc);

    //vérifie que le moteur n'existe pas déjà
    $verif = mysqli_query($conn, "SELECT * FROM contenu WHERE nom='$nom' OR lien='$lien'");
    $row_cnt = mysqli_num_rows($verif);

    //ajoute le moteur
    if ($row_cnt==0) {
      $req= mysqli_query($conn, "INSERT INTO contenu(nom, note, lien, totalnotes, description) VALUES ('$nom','0','$lien','0','$desc')") or die(mysqli_error($conn));

      $dossier = 'test/';
      $fichier = basename($_POST['nom'].".png");
      $nomImage=$dossier.$fichier;
      $moveImage = move_uploaded_file($_FILES['photo']['tmp_name'], $nomImage);
    }
  }

  header("Location: moteur.php?".$nom);
  exit();

?>
