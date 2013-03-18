<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $mysqli = new mysqli("127.0.0.1","root","!@#4dm!nCh4nge","php_mysql_simple_crud_schema");

  /* check connection */
  if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
  }

  // $name = mysql_real_escape_string($name);

  if ($stmt = $mysqli->prepare("DELETE FROM Users WHERE id=?")) {
    $stmt->bind_param('i', $_POST[id]);
    $stmt->execute();
    echo "Deleted 1 row from database\n";
    $stmt->close();
  } else {
    printf("Prepared Statement Error: %s\n", $mysqli->error);
  }
  
}

?>