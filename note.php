<?php
  session_start();
  include_once('connexionmysql.php');
  $conn=connexion();
  $contenu = $_POST['argh'];
  $postnote = $_POST['notation'];
  $req = mysqli_query($conn,"SELECT * FROM contenu WHERE nom = '$contenu'");
  $row = mysqli_fetch_array($req);
  $user=$_SESSION['nom'];
  $rowid = $row['0'];
  echo $rowid;
  $noteUser = mysqli_query($conn, "INSERT INTO notes(id, personne, note) VALUES ('$rowid','$user','$postnote')");
  $getNotes = $row['4'];
  $ajout = $getNotes+1;
  $setNoteActuelle = (($row['2']*$getNotes)+$_POST['notation'])/$ajout;
  $setRes = mysqli_query($conn,"UPDATE contenu SET note='$setNoteActuelle', totalnotes='$ajout' WHERE nom = '$contenu'");
  $adr="Location: moteur.php?".$contenu;
  header($adr);
  exit();
?>
