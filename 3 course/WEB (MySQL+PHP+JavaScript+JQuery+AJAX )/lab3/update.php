<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>База данных</title>
</head>
<body>
<form method="post" action="update.php">

 
 <input type = "hidden" name = "id" value = <?=$_GET["id"]?>>

floor

 <input type = "text" name = "floor" value = <?=$_GET["floor"]?>>

square

 <input type = "text" name = "square" value = <?=$_GET["square"]?>>

number_of_rooms
 <input type = "text" name = "number_of_rooms" value = <?=$_GET["number_of_rooms"]?>>

  price
  <input type="text" name="price" value = <?=$_GET["price"]?>>

  name_district
  <select name = "district_id">
    <option value = 1 <?php if ($_GET["district_id"] == "LENINSKY") echo 'selected = "selected"'; ?>>LENINSKY</option>
    <option value = 2 <?php if ($_GET["district_id"] == "MOSCOW") echo 'selected = "selected"'; ?>>MOSCOW</option>


  </select>

 fullname
  <select name = "owner_id">
    <option value = 1 <?php if ($_GET["owner_id"] == "IVANOV") echo 'selected = "selected"'; ?>>IVANOV</option>
    <option value = 2 <?php if ($_GET["owner_id"] == "PETROV") echo 'selected = "selected"'; ?>>PETROV</option>
    <option value = 3 <?php if ($_GET["owner_id"] == "BORISOV") echo 'selected = "selected"'; ?>>BORISOV</option>
    <option value = 4 <?php if ($_GET["owner_id"] == "PAVLOV") echo 'selected = "selected"'; ?>>PAVLOV</option>

  </select>


  <input type = "submit" value="Изменить">


</form>
</body>
</html>

<?php
if (!empty($_POST)) {
  @ $db = mysql_pconnect("localhost", "user303", "gun_centos_user_303");
  if (!$db){
    echo "Error: Could not connect to database.";
    exit;
  }
  mysql_select_db("user303");

$id = $_POST["id"];
$floor = $_POST["floor"];
$square = $_POST["square"];
$number_of_rooms = $_POST["number_of_rooms"];
$price= $_POST["price"];
$district_id = $_POST["district_id"];
$owner_id = $_POST["owner_id"];

  $query = "update apartments set floor = '".$floor."', square = '".$square."', number_of_rooms = '".$number_of_rooms."', price = '".$price."', district_id =  '".$district_id."', owner_id =  '".$owner_id."' where id = '".$id."'";
  $result = mysql_query($query);

  if ($result) {
    echo mysql_affected_rows() . "row updated.";
 echo $id;
  }
  header('Location: http://217.71.139.74/~user303/lab3/index.php');
  exit();
}
?>

