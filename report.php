<?php
  include("connexionmysql.php");
  $conn=connexion();

  $contenu = $_POST['argh'];
  $personne = $_POST['personne'];
  $id = $_POST['id'];

  $req = mysqli_query($conn, "UPDATE notes SET report = true WHERE personne = '$personne' AND id='$id'");
  $adr="Location: moteur.php?".$contenu;
  header($adr);
  exit();
  
?>
