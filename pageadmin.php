<?php
  session_start();
  include_once("connexionmysql.php");
  $conn = connexion();
  $user = $_SESSION['nom'];
  $a = mysqli_query($conn, "SELECT * FROM administrateur WHERE personne='$user'");
  $e = mysqli_fetch_array($a);
  if (strcmp($e['0'], $user)==0) {
    echo "<h1>Page administrateurs</h1>";
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
      echo "<form action=\"suppression.php\" method=\"post\">";
      echo "<input type=\"hidden\" name=\"bool\" value=\"1\">";
      echo "Utilisateur: ".$nomuser." <input type=\"image\" src=\"woofwoof.png\" width=\"32\" height=\"27\"alt=\"Submit\">"."<input type=\"hidden\" name=\"multisuppr\" value=\"$nomuser\">";
      echo "</form>";
    }
  } else {
    header("Location: erreur.html");
    exit();
  }
?>
