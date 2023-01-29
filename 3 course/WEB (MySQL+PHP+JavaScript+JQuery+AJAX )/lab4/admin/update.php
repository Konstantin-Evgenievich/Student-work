<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>База данных</title>
</head>
<body>
<?php
session_start();
if(($_SESSION["user"]['level'] === 'admin')&&(!empty($_GET))){
 
@ $db = mysql_pconnect("localhost", "user303", "gun_centos_user_303");
  if (!$db){
    echo "Error: Could not connect to database.";
    exit;
  }
  mysql_select_db("user303");


  $query = "select *from users where id = '".$_GET["id"]."'";
  $result = mysql_query($query);
  $row = mysql_fetch_array($result)
  ?>

  <FORM METHOD="POST" ACTION="update.php">
    Login: <input type=text NAME='login' value=<?=$_GET["login"]?>>
    Password: <input type=password NAME='pass1' value=<?=$row["password"]?>>
    Password: <input type=password NAME='pass2' value=<?=$row["passwordx2"]?>>
    Level <select name = "level">
      <option value = admin <?php if ($_GET["level"] == "admin") echo 'selected = "selected"'; ?>>admin</option>
      <option value = user <?php if ($_GET["level"] == "user") echo 'selected = "selected"'; ?>>user</option>
    </select>
    <input type = "hidden" name = "id" value = <?=$_GET["id"]?>>
      <INPUT type=submit value="Обновить">
  </FORM>

  <?php
  }
else{ ?>
  <div style="text-align: center;">
    <h1>У Вас нет прав доступа!</h1>
    <A HREF="../login.php">Вход</a><br>
    <a href="../index.php">Home Page</a> <br>
  </div>
  <?php
}
?>
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
  mysql_select_db("user306");
  $id = $_POST["id"];
  $login = $_POST["login"];
  $level = $_POST["level"];
  $pass1 = $_POST["pass1"];
  $pass2 = $_POST["pass2"];

  if($pass1 === $pass2){
    $query = "update users set login = '".$login."', level = '".$level."', password = '".$pass1."', passwordx2 = '".$pass2."' where id = '".$id."'";
    echo $query;
    $result = mysql_query($query);

    if ($result) {
      echo mysql_affected_rows() . "row updated.";
      echo $id;
    }

    header('Location: index.php');
    exit();
  }
  else {
    echo "Пароли не совпдают";

  }

}
?>



