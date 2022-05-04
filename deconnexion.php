<?php
  session_start();
  //vérification de si l'utilisateur vient du lien de l'accueil -> oui=session_destroy()+accueil.php , non=accesinterdit.html
  if($_SESSION['val']==1) {
    session_destroy();
    header('Location: index.php');
    exit();
  } else {
    header('Location: accesinterdit.html');
    exit();
  }

?>
