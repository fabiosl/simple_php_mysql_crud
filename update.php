<?php
include 'util.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' and filterPostParams()) {
  if ($stmt = $mysqli->prepare("UPDATE Users SET first_name=?, last_name=?, country=?, city=?, address=?, email=? WHERE id=?")) {
    $stmt->bind_param('ssssssi', strip_tags($_POST[first_name]), strip_tags($_POST[last_name]), strip_tags($_POST[country]), strip_tags($_POST[city]), strip_tags($_POST[address]), strip_tags($_POST[email]), strip_tags($_POST[id]));
    $stmt->execute();
    echo "Updated 1 row\n";
    $stmt->close();
  } else {
    printf("Prepared Statement Error: %s\n", $mysqli->error);
  }
  
} else {
    redirectTo403Page();
}

?>