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
  $noteUser = mysqli_query($conn, "INSERT INTO notes(id, personne, note) VALUES ('$rowid','$user','$postnote')");
  $getnotes = mysqli_query($conn, "SELECT AVG(note) FROM notes WHERE id = '$rowid'");
  $row2 = mysqli_fetch_array($getnotes);
  $setnote = $row2['0'];
  //$getNotes = $row['4'];
  $ajout = $row['4']+1;
  //$setNoteActuelle = (($row['2']*$getNotes)+$_POST['notation'])/$ajout;
  $setRes = mysqli_query($conn,"UPDATE contenu SET note='$setnote', totalnotes='$ajout' WHERE nom = '$contenu'");
  $adr="Location: moteur.php?".$contenu;
  header($adr);
  exit();
?>
