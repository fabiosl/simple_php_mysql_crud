<?php
include 'util.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' and filterPostParams()) {
  if ($stmt = $mysqli->prepare("INSERT INTO Users (first_name, last_name, country, city, address, email)  values (?, ?, ?, ?, ?, ?)")) {
    $stmt->bind_param('ssssss', strip_tags($_POST[first_name]), strip_tags($_POST[last_name]), strip_tags($_POST[country]), strip_tags($_POST[city]), strip_tags($_POST[address]), strip_tags($_POST[email]));
    $stmt->execute();
    echo "Inserted 1 row into database\n";
    $stmt->close();
  } else {
    printf("Prepared Statement Error: %s\n", $mysqli->error);
  }
  
} else {
    redirectTo403Page();
}

?>