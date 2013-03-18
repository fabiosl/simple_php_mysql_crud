<?php
include 'util.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if ($stmt = $mysqli->prepare("DELETE FROM Users WHERE id=?")) {
    $stmt->bind_param('i', $_POST[id]);
    $stmt->execute();
    echo "Deleted 1 row from database\n";
    $stmt->close();
  } else {
    printf("Prepared Statement Error: %s\n", $mysqli->error);
  }
  
}else{
  redirectTo403Page();
}

?>