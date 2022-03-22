<?php
  function connexion() {
    $conn = new mysqli("localhost", "test", "test", "test1");
    if (!$conn) exit;
    return $conn;
  }
?>
