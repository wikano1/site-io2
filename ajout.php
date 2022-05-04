<?php
  include_once("connexionmysql.php");
  $conn=connexion();
  //verifie si l'utilisateur a utilisé le formulaire | non=accèsinterdit.html
  if(isset($_FILES['photo']) AND isset($_POST['nom']) AND isset($_POST['lien']) AND isset($_POST['desc'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $lien = htmlspecialchars($_POST['lien']);
    $desc = htmlspecialchars($_POST['desc']);
    $desc = str_replace("'", "\'", $desc);
    //verifie que le moteur n'existe pas déjà
    $verif = mysqli_query($conn, "SELECT * FROM contenu WHERE nom='$nom' OR lien='$lien'");
    $row_cnt = mysqli_num_rows($verif);
    if ($row_cnt==0) {
      //ajoute le moteur dans la bdd
      $req= mysqli_query($conn, "INSERT INTO contenu(nom, note, lien, totalnotes, description) VALUES ('$nom','0','$lien','0','$desc')") or die(mysqli_error($conn));
      $dossier = 'test/';
      $fichier = basename($_POST['nom'].".png");
      $a=$dossier.$fichier;
      $e = move_uploaded_file($_FILES['photo']['tmp_name'], $a);
    }
  } else {
    header('Location: accesinterdit.html');
    exit();
  }

  header("Location: moteur.php?".$nom);
  exit();

?>
