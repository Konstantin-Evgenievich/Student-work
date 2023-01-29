<?php
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
?>

