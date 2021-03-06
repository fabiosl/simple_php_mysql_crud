<?php
$field_array = array("first_name","last_name", "country", "city", "address", "email");
$direction_array = array("asc","desc");
$mysqli = new mysqli("127.0.0.1","root","!@#4dm!nCh4nge","php_mysql_simple_crud_schema");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

function getTableRowControlField($row_id){
  $save_button_id = "save_button_" . $row_id;
  $edit_button_id = "edit_button_" . $row_id;
  $delete_button_id = "delete_button_" . $row_id;
  $result = "<button id='{$edit_button_id}'  type='button' onclick='editRow({$row_id})'>Edit!</button>" ;
  $result .= "<button id='{$save_button_id}' style='display:none' type='button' onclick='saveRow({$row_id})'>Save!</button>";
  $result .=  "<button id='{$delete_button_id}'type='button' onclick='deleteRow({$row_id})'>Delete!</button>";
  return $result;
}

function allParamsAreSetted(){ //variable number of arguments
  $numargs = func_num_args();
  $arg_list = func_get_args();
  for ($i = 0; $i < $numargs; $i++) {
    $exists = isSet($arg_list[$i]) and !empty($arg_list[$i]);
    if (!$exists){
      return false;
    }
  }
  return true;
}

function validateOrderBy($order_by,$direction){
  global $field_array, $direction_array;
  return allParamsAreSetted($order_by, $direction) and in_array($order_by, $field_array) and in_array($direction, $direction_array);
}

function hasHTMLTags($variable){
  return strip_tags($variable) != $variable;
}


function filterPostParams() {
  //Checks if any parameter contains HTML tags.
  foreach ($_POST as $key => $value){
    if(hasHTMLTags($value)){
      return false;
    }  
  }
  
  //Validates email field
  if (!filter_var($_POST[email], FILTER_VALIDATE_EMAIL)){
    return false;
  }
  
  return true;
}

function redirectTo403Page(){
  header('HTTP/1.0 403 Forbidden');
  echo "<h1>403 Not Found</h1>";
  echo "The page that you have requested could not be found.";
  exit();
}

function getArrowImage($orientation){
  if ($orientation == "asc"){
    return "img/up.png";
  }else if ($orientation == "desc"){
    return "img/down.png";
  }
}

function getInverse($orientation){
  if ($orientation == "asc"){
    return "desc";
  }else if ($orientation == "desc"){
    return "asc";
  }
}


?>