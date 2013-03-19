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
      echo "<table cellspacing='0'> <!-- cellspacing='0' is important, must stay -->";
        
        // Table Header
        echo "<thead>";
          echo "<tr>";
          foreach ($field_array as &$field) {
            $selected = ($field == $_GET["order_by"]);
            
            if ($selected){
              $image = getArrowImage($_GET["direction"]);
              $imageTag = "<img style='margin-left:5px;' src='{$image}'>";
              echo "<th><a href='?&order_by={$field}&direction=" . getInverse($_GET["direction"]) . "'>". ucwords(str_replace("_", " ", $field)) . "</a>{$imageTag}</th>";
            }
            else {
              echo "<th><a href='?&order_by={$field}&direction=asc'>". ucwords(str_replace("_", " ", $field)) . "</a></th>";
            }
          }
          echo "</tr>";
        echo "</thead>";
        

        // Table Body
        echo "<tbody>";
            $orderedQuery = validateOrderBy($_GET["order_by"], $_GET["direction"]);
            $sql = ($orderedQuery ? "SELECT * FROM Users ORDER BY {$_GET['order_by']} {$_GET['direction']}" : "SELECT * FROM Users ");
            if ($stmt = $mysqli->prepare($sql)) {
              $stmt->execute();
              $stmt->bind_result($id, $first_name, $last_name, $country, $city, $address, $email);
              while ($stmt->fetch()) {
                echo "<tr row_id='{$id}' class='even'>";
                echo "<td class='row_field' name='id' style='display:none'>{$id}</td>";
                echo "<td class='row_field' name='first_name'>" . htmlspecialchars($first_name) . "</td>";
                echo "<td class='row_field' name='last_name'>" . htmlspecialchars($last_name) . "</td>";
                echo "<td class='row_field' name='country'>" . htmlspecialchars($country) . "</td>";
                echo "<td class='row_field' name='city'>" . htmlspecialchars($city) . "</td>";
                echo "<td class='row_field' name='address'>" . htmlspecialchars($address) . "</td>";
                echo "<td class='row_field' name='email'>" . htmlspecialchars($email) . "</td>";
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
      <input type="text" placeholder="First name" name="first_name" maxlength="45">
      <input type="text" placeholder= "Last name" name="last_name" maxlength="45">
      <input type="text" placeholder= "Country" name="country" maxlength="45">
      <input type="text" placeholder= "City" name="city" maxlength="45">
      <input type="text" placeholder= "Address" name="address" maxlength="45">
      <input type="text" placeholder= "Email" name="email" maxlength="45">
      <input type="submit">
    </form>

  </body>
</html>