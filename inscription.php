<?php
include_once("connexionmysql.php");

$conn=connexion();
$aaa = $_POST[nom];
$bbb = $_POST[mdp];

$instruction = "INSERT INTO utilisateur(nom, motdepasse) VALUES ('$aaa', '$bbb')";

if (mysqli_query($conn,$instruction)) echo "compte créé, veuillez retourner à l'accueil<br><a href=accueil.html>aa</a>";

$conn->close();
?>
