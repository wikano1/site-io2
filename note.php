<?php
  session_start();
  include_once('connexionmysql.php');
  $conn=connexion();
  if (isset($_POST['notation'])) {
    $contenu = htmlspecialchars($_POST['argh']);
    $postnote = htmlspecialchars($_POST['notation']);
    $postavis = htmlspecialchars($_POST['avis']);
    $req = mysqli_query($conn,"SELECT * FROM contenu WHERE nom = '$contenu'");
    $row = mysqli_fetch_array($req);
    $user=$_SESSION['nom'];
    $rowid = $row['0'];
    echo $rowid."<br>";
    echo $user."<br>";
    echo $postnote."<br>";
    echo $postavis."<br>";
    $postavis = str_replace("'", "\'", $postavis);
    $instruction = "INSERT INTO notes(id, personne, note, avis,report) VALUES ('$rowid','$user','$postnote','$postavis','0')";
    $noteUser = mysqli_query($conn, $instruction);
    $getnotes = mysqli_query($conn, "SELECT AVG(note) FROM notes WHERE id = '$rowid'");
    $row2 = mysqli_fetch_array($getnotes);
    $setnote = $row2['0'];
    //$getNotes = $row['4'];
    $ajout = $row['4']+1;
    //$setNoteActuelle = (($row['2']*$getNotes)+$_POST['notation'])/$ajout;
    $setRes = mysqli_query($conn,"UPDATE contenu SET note='$setnote', totalnotes='$ajout' WHERE nom = '$contenu'");
    $adr="Location: moteur.php?".$contenu;
  }

  header($adr);
  exit();
?>
