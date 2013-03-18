<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/main.css" type="text/css">
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
</head>

<body>
  <!-- AJAX Overlay-->
  <div id="loading-div-background">
    <div id="bg-loading-image">
      <div id="loading-text"> Loading </div>
    </div>
  </div>

  <!-- Order By form-->
  <div>
  <?php
  $field_array = array("first_name","last_name", "country", "city", "address", "email");
  $direction_array = array("asc","desc");
  echo "<form action='index.php' id='order_by_form' method='GET'>";  

  echo  "<select name='order_by'>";
  foreach ($field_array as &$field) {
    $selected = ($field == $_GET["order_by"] ? "selected='selected'" : "");
    echo "<option value='{$field}' {$selected}  >{$field}</option>";
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
  ?>
  </div>

  <table cellspacing='0'> <!-- cellspacing='0' is important, must stay -->
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
      function getTableRowControlField($row_id){
        $save_button_id = "save_button_" . $row_id;
        $edit_button_id = "edit_button_" . $row_id;
        $delete_button_id = "delete_button_" . $row_id;
        $result = "<button id='{$edit_button_id}'  type='button' onclick='editRow({$row_id})'>Edit!</button>" ;
        $result .= "<button id='{$save_button_id}' style='display:none' type='button' onclick='saveRow({$row_id})'>Save!</button>";
        $result .=  "<button id='{$delete_button_id}'type='button' onclick='deleteRow({$row_id})'>Delete!</button>";
        return $result;
      }

      function validateOrderBy($order_by,$direction){
        return isSet($order_by) and isSet($direction);
      }
      
      function getSelectStatement(){
        $sql = "SELECT * FROM Users ";
        if (validateOrderBy($_GET["order_by"], $_GET["direction"])){
          $sql .= "ORDER BY {$_GET['order_by']} {$_GET['direction']}";
        }  
        return $sql;
      }

      $connection=mysqli_connect("localhost:3306","root","!@#4dm!nCh4nge","php_mysql_simple_crud_schema");
      
      if (mysqli_connect_errno($connection)){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      } 


      $users = mysqli_query($connection, getSelectStatement());
      while($row = mysqli_fetch_array($users)){
        echo "<tr row_id='{$row['id']}' class='even'>";
        echo "<td class='row_field' name='id' style='display:none'>{$row['id']}</td>";
        echo "<td class='row_field' name='first_name'>{$row['first_name']}</td>";
        echo "<td class='row_field' name='last_name'>{$row['last_name']}</td>";
        echo "<td class='row_field' name='country'>{$row['country']}</td>";
        echo "<td class='row_field' name='city'>{$row['city']}</td>";
        echo "<td class='row_field' name='address'>{$row['address']}</td>";
        echo "<td class='row_field' name='email'>{$row['email']}</td>";
        echo "<td>". getTableRowControlField($row['id']) ."</td>";
        echo "</tr><!-- Table Row -->";
      }

      mysqli_close($connection);
      ?>      
    </tbody>
  </table>

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