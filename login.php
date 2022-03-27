<?php
   include("connexionmysql.php");
   $conn=connexion();
   $res = mysqli_query($conn,"SELECT * FROM utilisateur WHERE nom = 'oui' AND motdepasse = 'non'");
   $nb = mysqli_num_rows($res);
   echo $nb;
?>
