<html>

<head>
  <link rel="stylesheet" href="css/main.css" type="text/css">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
</head>

<body>
  <table cellspacing='0'> <!-- cellspacing='0' is important, must stay -->
    <?php
    $con=mysqli_connect("localhost:3306","root","!@#4dm!nCh4nge","php_mysql_simple_crud_schema");

    if (mysqli_connect_errno($con)){
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } 
    
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

      <tr>
        <td>Fabio</td>
        <td>Leal</td>
        <td>Brazil</td>
        <td>Joao Pessoa</td>
        <td>Av. Sape, 1393, Ap 1901</td>
        <td>hey@ho.lets.go</td>
      </tr><!-- Table Row -->

      <tr class="even">
        <td>Milena</td>
        <td>Berry</td>
        <td>USA</td>
        <td>New York</td>
        <td>350 Fifth Avenue, 34th floor.</td>
        <td>hey@ho.lets.go</td>
      </tr><!-- Darker Table Row -->

      <tr class="even">
        <td><a href="#yep-iit-doesnt-exist">Hyperlink</a></td>
        <td>80%</td>
        <td><a href="#inexistent-id">Another</a></td>
        <td><a href="#inexistent-id">Another</a></td>
        <td><a href="#inexistent-id">Another</a></td>
        <td><a href="#inexistent-id">Another</a></td>
      </tr>

    </tbody>
    <!-- Table Body -->

  </table>
</body>
</html>