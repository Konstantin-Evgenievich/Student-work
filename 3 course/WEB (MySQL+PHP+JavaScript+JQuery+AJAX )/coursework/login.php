<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Вход в базу данных пользователей</title>
</head>
<body>
<?php

  session_start();

if(!isset($_SESSION["user"])) {
  if (!empty($_POST)) {
    @ $db = mysql_pconnect("localhost", "user303", "gun_centos_user_303");
    if (!$db) {
      echo "Error: Could not connect to database.";
      exit;
    }
    @$db=mysql_select_db("user303");
        if (!$db) {
        echo "Can't change database!";
        exit;
        }
    $login = $_POST["login"];
    $password = $_POST["password"];

    $query = "select *from users where login = '".$login."' and password = '".$password."';";
    $result = mysql_query($query);
    $rows = mysql_num_rows($result);
    if ($rows > 0) {
      $user = mysql_fetch_assoc($result);
      echo $user['id'];

      $_SESSION['user'] = array(
        "id" => $user['id'],
        "login" => $user['login'],
        "level" => $user['level']
      );

    } else {
      echo $query;
      echo "<br/>";
      echo $result;
      echo "<br/> Количество строк равно: ";
      echo $rows;
      echo "<br/>";
      echo "Такого аккаунта не существует";
    }
  }
}
  if(!isset($_SESSION["user"])) {?>
  <form method = post action = "login.php">
    <h3>Вход</h3>

    Ваш login: <input type = text name = "login"></br>
    <br>Ваш password: <input type = password name = "password"> </br>
    <input type = submit name = "action" value="Login">

  </form>
 <br>
    <a href=index.php>Home Page</a> <br>

    <?php
  }
  else{?>
    user<h3>Hello <?=$_SESSION['user']['login']?></h3><h3>Your level is <?=$_SESSION['user']['level']?></h3><a href=index.php>Home Page</a><br><a href=exit.php>Выход</a><br>

  <?php
  }
?>

</body>
</html>


