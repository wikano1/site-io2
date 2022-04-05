<?php
  session_start();
  if($_SESSION['bool']==1) {
    session_destroy();
    header('Location: accueil.php');
    exit();
  } else {
    $_SESSION['bool'] = 0;
    header('Location: accesinterdit.html');
    exit();
  }

?>
