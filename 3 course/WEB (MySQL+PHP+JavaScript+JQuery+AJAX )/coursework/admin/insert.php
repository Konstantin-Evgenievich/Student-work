<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>База данных пользователей </title>
</head>
<body>
<?php
session_start();
if($_SESSION["user"]['level'] === 'admin') {?>
<form method="post" action="insert.php">
  Login: <input type=text NAME='login'><br>
  Password: <INPUT type=password name="pass1" size=8><br>
  Password: <INPUT type=password name="pass2" size=8><br>
  Level: <SELECT NAME='levels'>";
    <option value=admin>admin<option value=user>user
  </select>
  <br>
  <INPUT type=submit value="Добавить">
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

  $login = $_POST["login"];
  $password = $_POST["pass1"];
  $passwordx2 = $_POST["pass2"];
  if ($password === $passwordx2) {
    $level = $_POST["levels"];

    $query = "insert into users (login, password, level, passwordx2) values ('" . $login . "','" . $password . "', '" . $level . "', '" . $passwordx2 . "')";
    $result = mysql_query($query);

    if ($result) {
      echo mysql_affected_rows() . "row(s) inserted.";
    }

   header('Location: index.php');
    exit();
  } else {
    echo "Пароли не совпадают";
  }
}
} else {
  ?>
  <div style="text-align: center;">
    <h1>У Вас нет прав доступа!</h1>
  <A HREF="../login.php">Вход</a><br>
<a href="../index.php">Home Page</a> <br>
  </div>
  <?php
}
?>


