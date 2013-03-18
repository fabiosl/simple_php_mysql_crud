<?php
$connection=mysqli_connect("localhost:3306","root","!@#4dm!nCh4nge","php_mysql_simple_crud_schema");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="DELETE FROM Users WHERE id='$_POST[id]'";

if (!mysqli_query($connection,$sql)){
  die('Error: ' . mysqli_error());
}
echo "1 record deleted";
mysqli_close($connection);
?>