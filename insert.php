<?php
$connection=mysqli_connect("localhost:3306","root","!@#4dm!nCh4nge","php_mysql_simple_crud_schema");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="INSERT INTO Users (first_name, last_name, country, city, address, email)
VALUES
('$_POST[first_name]','$_POST[last_name]','$_POST[country]','$_POST[city]','$_POST[address]','$_POST[email]')";

if (!mysqli_query($connection,$sql))
  {
  die('Error: ' . mysqli_error());
  }
echo "1 record added";

mysqli_close($connection);
?>