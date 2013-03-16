<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/main.css" type="text/css">
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
</head>

<body>
  <table cellspacing='0'> <!-- cellspacing='0' is important, must stay -->
    <?php
    ?>
    <!-- Table Header -->
    <thead>      
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Country</th>
        <th>City</th>
        <th>Address</th>
        <th>Email</th>
      </tr>
    </thead>
    <!-- Table Header -->

    <!-- Table Body -->
    <tbody>
      <?php
  
      $connection=mysqli_connect("localhost:3306","root","!@#4dm!nCh4nge","php_mysql_simple_crud_schema");
      if (mysqli_connect_errno($connection)){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      } 

      $users = mysqli_query($connection, "SELECT * FROM Users");

      while($row = mysqli_fetch_array($users)){
        echo "<tr class='even'>";
        echo "<td>" . $row['first_name'] ."</td>";
        echo "<td>" . $row['last_name'] ."</td>";
        echo "<td>" . $row['country'] ."</td>";
        echo "<td>" . $row['city'] ."</td>";
        echo "<td>" . $row['address'] ."</td>";
        echo "<td>" . $row['email'] ."</td>";
        echo "</tr><!-- Table Row -->";
      }

      mysqli_close($connection);
      ?>      
     

    </tbody>

    <!-- Table Body -->
  </table>

  <form id="add_user_form" method="POST">
    <td><input type="text" name="first_name"></td>
    <td><input type="text" name="last_name"></td>
    <td><input type="text" name="country"></td>
    <td><input type="text" name="city"></td>
    <td><input type="text" name="address"></td>
    <td><input type="text" name="email"><input type="submit"></td>
  </form>


</body>
</html>