<?php
  session_start();
  include("connexionmysql.php");
  $conn = connexion();
  //test effacement admin ou non
  if(isset($_POST['bool'])) {
    header("Location: pageadmin.php");
  } else {
    //header("location: profil.php");
  }
  //effacer une note
  if(isset($_POST['supprimer'])) {
    $user = $_POST['supprimer'];
    $idnote = $_POST['idnote'];
  } else {
    if (isset($_POST['supprimer2'])){
      $user = $_SESSION['nom'];
      $idnote = $_POST['supprimer2'];
    }
  }
  $total = mysqli_query($conn, "SELECT totalnotes FROM contenu WHERE id = '$idnote'");
  $m = mysqli_fetch_array($total);
  $newtotal = $m['0']-1;
  $req = mysqli_query($conn, "UPDATE contenu SET totalnotes='$newtotal' WHERE id='$idnote'");
  $req2 = mysqli_query($conn, "DELETE FROM notes WHERE id = '$idnote' AND personne = '$user'");
  $moy = mysqli_query($conn, "SELECT AVG(note) FROM notes WHERE id = '$idnote'");
  $m1 = mysqli_fetch_array($moy);
  $newmoy = $m1['0'];
  $req = mysqli_query($conn, "UPDATE contenu SET note='$newmoy' WHERE id='$idnote'");
  //effacer un compte
  if(isset($_POST['multisuppr'])) {
    $userasuppr = $_POST['multisuppr'];
    $nbrows = mysqli_query($conn, "SELECT id FROM notes WHERE personne = '$userasuppr'");
    while($row = mysqli_fetch_array($nbrows)) {
      $val = $row['0'];
      $moy = mysqli_query($conn, "SELECT AVG(note) FROM notes WHERE id = '$val' AND personne != '$userasuppr'");
      $m1 = mysqli_fetch_array($moy);
      $newmoy = $m1['0'];
      $req = mysqli_query($conn, "UPDATE contenu SET note='$newmoy' WHERE id='$val'");
      $total = mysqli_query($conn, "SELECT totalnotes FROM contenu WHERE id = '$val'");
      $m = mysqli_fetch_array($total);
      $newtotal = $m['0']-1;
      $req = mysqli_query($conn, "UPDATE contenu SET totalnotes='$newtotal' WHERE id='$val'");
    }
    $req = mysqli_query($conn, "DELETE FROM notes WHERE personne = '$userasuppr'");
    $req2 = mysqli_query($conn, "DELETE FROM utilisateur WHERE nom = '$userasuppr'");
  }
  header("Location: pageadmin.php");
?>
