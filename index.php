<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <title>PHP & MySQL Simple CRUD</title>
  </head>

  <body>
    <!-- AJAX Overlay-->
    <div id="loading-div-background">
      <div id="bg-loading-image">
        <div id="loading-text"> Loading </div>
      </div>
    </div>

    <!-- Order By form-->
    <?php
      include 'util.php';
      
      echo "<div>";
        echo "<form action='index.php' id='order_by_form' method='GET'>";  
          echo  "<select name='order_by'>";
          foreach ($field_array as &$field) {
            $selected = ($field == $_GET["order_by"] ? "selected='selected'" : "");
            echo "<option value='{$field}' {$selected}>" . ucwords(str_replace("_", " ", $field)) . "</option>";
          }
          echo "</select>";
        
          echo "<select name='direction'>";
          foreach ($direction_array as &$field) {
            $selected = ($field == $_GET["direction"] ? "selected='selected'" : "");
            echo "<option value='{$field}' {$selected}  >{$field}</option>";
          }
          echo "</select>";
          
          echo "<input type='submit'>";
        echo "</form>";
      echo "</div>";

      echo "<table cellspacing='0'> <!-- cellspacing='0' is important, must stay -->";
        
        // Table Header
        echo "<thead>";
          echo "<tr>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Country</th>";
            echo "<th>City</th>";
            echo "<th>Address</th>";
            echo "<th>Email</th>";
          echo "</tr>";
        echo "</thead>";
        

        // Table Body
        echo "<tbody>";
            $mysqli = new mysqli("localhost:3306","root","!@#4dm!nCh4nge","php_mysql_simple_crud_schema");

            /* check connection */
            if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
            }

            $orderedQuery = validateOrderBy($_GET["order_by"], $_GET["direction"]);
            $sql = ($orderedQuery ? "SELECT * FROM Users ORDER BY {$_GET['order_by']} {$_GET['direction']}" : "SELECT * FROM Users ");
            if ($stmt = $mysqli->prepare($sql)) {
              $stmt->execute();
              $stmt->bind_result($id, $first_name, $last_name, $country, $city, $address, $email);
              while ($stmt->fetch()) {
                echo "<tr row_id='{$id}' class='even'>";
                echo "<td class='row_field' name='id' style='display:none'>{$id}</td>";
                echo "<td class='row_field' name='first_name'>{$first_name}</td>";
                echo "<td class='row_field' name='last_name'>{$last_name}</td>";
                echo "<td class='row_field' name='country'>{$country}</td>";
                echo "<td class='row_field' name='city'>{$city}</td>";
                echo "<td class='row_field' name='address'>{$address}</td>";
                echo "<td class='row_field' name='email'>{$email}</td>";
                echo "<td>". getTableRowControlField($id) ."</td>";
                echo "</tr><!-- Table Row -->";
              }
              $stmt->close();
            } else {
              printf("Prepared Statement Error: %s\n", $mysqli->error);
            }

            mysqli_close($connection);
        echo  "</tbody>";
      echo "</table>";
    ?>     

    <form id="add_user_form" method="POST">
      <input type="text" placeholder="First name" name="first_name">
      <input type="text" placeholder= "Last name" name="last_name">
      <input type="text" placeholder= "Country" name="country">
      <input type="text" placeholder= "City" name="city">
      <input type="text" placeholder= "Address" name="address">
      <input type="text" placeholder= "Email" name="email">
      <input type="submit">
    </form>
  </body>
</html>