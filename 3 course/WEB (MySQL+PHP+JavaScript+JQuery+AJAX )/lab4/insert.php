<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>База данных</title>
</head>
<body>
<?php
session_start();
if (isset($_SESSION["user"])) { ?>

<form method="post" action="insert.php">

floor
  <input type="text" name="floor">

square
  <input type="text" name="square">

 number_of_rooms
  <input type="text" name="number_of_rooms">

  price
  <input type="text" name="price">

 name_district
  <select name = "district_id">
    <option value = 1>LENINSKY</option>
    <option value = 2>MOSCOW</option>
  </select>

  fullname
 <select name = "owner_id">
    <option value = 1>IVANOV</option>
    <option value = 2>PETROV</option>
    <option value = 3>BORISOV</option>
    <option value = 4>PAVLOV</option>
  </select>


  <input type = "submit" value="Добавить">


</form>

<?php
@ $db = mysql_pconnect("localhost", "user303", "gun_centos_user_303");
if (!$db){
  echo "Error: Could not connect to database.";
  exit;
}
mysql_select_db("user303");
$floor = $_POST["floor"];
$square = $_POST["square"];
$number_of_rooms = $_POST["number_of_rooms"];
$price= $_POST["price"];
$district_id = $_POST["district_id"];
$owner_id = $_POST["owner_id"];


if (!empty($_POST)) {
  $query = "insert into apartments (floor, square, number_of_rooms, price, district_id, owner_id) values ('".$floor."', '".$square."','".$number_of_rooms."', '".$price."', '".$district_id."', '".$owner_id."')";
  $result = mysql_query($query);

  if ($result) {
    echo mysql_affected_rows() . "row(s) inserted.";
  }

  header('Location: index.php');
  exit();
  }
}
else{?>
<div style="text-align: center;">
<h1>У вас нет прав доступа!</h1>
<a href=login.php>Вход</a>
<a href="index.php">Home Page</a><br>
</div>
<?php
}
?>
</body>
</html>



