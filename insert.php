<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $mysqli = new mysqli("localhost:3306","root","!@#4dm!nCh4nge","php_mysql_simple_crud_schema");

  /* check connection */
  if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
  }

  // $name = mysql_real_escape_string($name);

  if ($stmt = $mysqli->prepare("INSERT INTO Users (first_name, last_name, country, city, address, email)  values (?, ?, ?, ?, ?, ?)")) {
    $stmt->bind_param('ssssss', $_POST[first_name],$_POST[last_name],$_POST[country],$_POST[city],$_POST[address],$_POST[email]);
    $stmt->execute();
    echo "Inserted 1 row into database\n";
    $stmt->close();
  } else {
    printf("Prepared Statement Error: %s\n", $mysqli->error);
  }
  
}

?>