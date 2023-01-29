<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>База данных</title>
</head>
<body>
<?php
session_start();
if(($_SESSION["user"])['level'] == 'admin')&&(!empty($_GET))){
@ $db = mysql_pconnect("localhost", "user303", "gun_centos_user_303");
if (!$db){
  echo "Error: Could not connect to database.";
  exit;
}
mysql_select_db("user303");
$query = "delete from apartments where id ='".$_GET["id"]."'";
$result = mysql_query($query);
header('Location: index.php');
exit();
} else{?>
  <div style="text-align: center;">
    <h1>У Вас нет прав доступа!</h1>
    <A HREF=login.php>Вход</a><br>
    <a href=index.php>Home Page</a> <br>

  </div>
  <?php
}
?>
</body>
</html>

