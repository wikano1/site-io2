<?php
  include("index.php");
  if (isset($_SESSION['nom'])) {
    $user = $_SESSION['nom'];
  }
  if(isset($user)) {
    if($user!=null) {
?>
    <div class="profil"> <h1>Profil de <?php echo $user; ?></h1>
    <?php
      $res = mysqli_query($conn,"SELECT * FROM notes WHERE personne = '$user'");
    ?>
    <p>Notes :</p>
    <?php
      while ($row = mysqli_fetch_array($res)) {
      $idnote = $row['0'];
      $req = mysqli_query($conn,"SELECT nom FROM contenu WHERE id = '$idnote'");
      $contenu = mysqli_fetch_array($req);
    ?>
    <form action="suppression.php" method="post">
      <p>
        <?php echo $contenu['0']; ?> : <?php echo $row['2']; ?>
        <input type="image" src="croix.png" width="32" height="27"alt="Submit">
      </p>
      <input type="hidden" name="supprimer2" value=<?php echo $idnote; ?>>
    </form>
<?php
      }
    }
  }
  else {
?>
  <p>Vous n'êtes pas connecté</p>
  <?php
    }
  ?>
    </div>
  </body>
</html>
