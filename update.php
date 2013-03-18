<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $mysqli = new mysqli("localhost:3306","root","!@#4dm!nCh4nge","php_mysql_simple_crud_schema");

  /* check connection */
  if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
  }

  // $name = mysql_real_escape_string($name);

  if ($stmt = $mysqli->prepare("UPDATE Users SET first_name=?, last_name=?, country=?, city=?, address=?, email=? WHERE id=75")) {
    $stmt->bind_param('ssssssi', $_POST[first_name], $_POST[last_name], $_POST[country], $_POST[city], $_POST[address], $_POST[email], $_POST[id]);
    $stmt->execute();
    echo "Updated 1 row\n";
    $stmt->close();
  } else {
    printf("Prepared Statement Error: %s\n", $mysqli->error);
  }
  
}

?>