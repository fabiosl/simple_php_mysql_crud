<?php
include 'util.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' and filterPostParams()) {
  $mysqli = new mysqli("127.0.0.1","root","!@#4dm!nCh4nge","php_mysql_simple_crud_schema");

  /* check connection */
  if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
  }

  if ($stmt = $mysqli->prepare("UPDATE Users SET first_name=?, last_name=?, country=?, city=?, address=?, email=? WHERE id=?")) {
    $stmt->bind_param('ssssssi', strip_tags($_POST[first_name]), strip_tags($_POST[last_name]), strip_tags($_POST[country]), strip_tags($_POST[city]), strip_tags($_POST[address]), strip_tags($_POST[email]), strip_tags($_POST[id]));
    $stmt->execute();
    echo "Updated 1 row\n";
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