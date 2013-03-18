<?php
$connection=mysqli_connect("localhost:3306","root","!@#4dm!nCh4nge","php_mysql_simple_crud_schema");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="UPDATE Users SET first_name='$_POST[first_name]', last_name='$_POST[last_name]', country='$_POST[country]', city='$_POST[city]', address='$_POST[address]', email='$_POST[email]' WHERE id='$_POST[id]'";

if (!mysqli_query($connection,$sql)){
  die('Error: ' . mysqli_error());
}

echo "1 record updated";
mysqli_close($connection);
?>