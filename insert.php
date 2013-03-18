<?php
include 'util.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' and filterPostParams()) {

  $mysqli = new mysqli("localhost:3306","root","!@#4dm!nCh4nge","php_mysql_simple_crud_schema");

  /* check connection */
  if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
  }

  // $name = mysql_real_escape_string($name);

  if ($stmt = $mysqli->prepare("INSERT INTO Users (first_name, last_name, country, city, address, email)  values (?, ?, ?, ?, ?, ?)")) {
    $stmt->bind_param('ssssss', strip_tags($_POST[first_name]), strip_tags($_POST[last_name]), strip_tags($_POST[country]), strip_tags($_POST[city]), strip_tags($_POST[address]), strip_tags($_POST[email]));
    $stmt->execute();
    echo "Inserted 1 row into database\n";
    $stmt->close();
  } else {
    printf("Prepared Statement Error: %s\n", $mysqli->error);
  }
  
} else {
    header('HTTP/1.0 403 Forbidden');
    echo "<h1>403 Not Found</h1>";
    echo "The page that you have requested could not be found.";
    exit();
}

?>