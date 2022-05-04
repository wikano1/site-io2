<?php
  
  include("index.php");
  if (isset($_SESSION['nom'])) {
    $user = $_SESSION['nom'];
  }
?>

    <?php if(isset($user)) {
        if($user!=null) {
            echo '<div class="profil"> <h1>Profil de '.$user."</h1>";
            $res = mysqli_query($conn,"SELECT * FROM notes WHERE personne = '$user'");
            echo "<p>Notes :</p>";
            while ($row = mysqli_fetch_array($res)) {
              $idnote = $row['0'];
              $req = mysqli_query($conn,"SELECT nom FROM contenu WHERE id = '$idnote'");
              $contenu = mysqli_fetch_array($req);
              echo "<form action=\"suppression.php\" method=\"post\">";
              echo $contenu['0']." : ".$row['2']."  "."<input type=\"image\" src=\"woofwoof.png\" width=\"32\" height=\"27\"alt=\"Submit\">"."<input type=\"hidden\" name=\"supprimer2\" value=\"$idnote\">";
              echo "</form>";
            }
          }
        } else {
          echo "<p>Vous n'êtes pas connecté</p>";
        }
        echo "</div>"
    ?>
    
  </body>
</html>
