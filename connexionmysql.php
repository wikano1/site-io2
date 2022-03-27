<?php
  function connexion() {
    $conn = mysqli_connect("localhost", "test", "test", "test1");
    if (!$conn) exit;
    return $conn;
  }
?>
