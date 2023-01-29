<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>База данных</title>
</head>
<body bgcolor="#fa8e47">
<?php
session_start();
if($_SESSION["user"]['level'] === 'admin') {?>
<div style="text-align: center;">
  <h1>
    База данных квартир
  </h1>
  <br>
 <?php
  @ $db = mysql_pconnect("localhost", "user303", "gun_centos_user_303");
  if (!$db){
    echo "Error: Could not connect to database.";
    exit;
  }
  mysql_select_db("user303");
  $search = $_POST["poisk"];
  if (!empty($_POST)){
    $query = "select *from users where login = '".$search."'";
  }
  else{
    $query = "select *from users";
  }

  $result = mysql_query($query);

  if ($result) {?>

  <div style="text-align: center;">
    <center>
      <table border = "1">
        <tbody>
	<tr><td>id</td><td>login</td><td>level</td><td>UPDATE</td><td>DELETE</td></tr>
	
	
	<?php while ($row = mysql_fetch_array($result)){?>
	
          <tr>
          <td><?=$row["id"]?></td><td><?=$row["login"]?></td><td><?=$row["level"]?></td>
          
	    <td><a href="update.php?id=<?=$row['id']?>&login=<?=$row['login']?>&level=<?=$row['level']?>">update</a></td>
            <td><a href="delete.php?id=<?=$row['id']?>">Delete</a></td>
          </tr>
          <?php
        }
        }
        ?>
        </tbody>
      </table>
    </center>
  </div>
  <br>
 <form method = "post" action="index.php">
    <div style="text-align: center;">
      Поиск по login
      <input type = "text" name = "poisk" size = 10>
      <input type = "submit" value = "Поиск">
    </div>
  </form>
  <br>
  <a href = index.php>Show All (Показать все)</a> <br>
  <a href = insert.php>Insert (Добавить)</a> <br>
  <a href = ../exit.php> LOGOUT (выход)</a> <br>
  <a href = ../index.php>Квартиры (Стартовая)</a><br>
  <?php
}else {?>
    <div style="text-align: center;">
     <h1>У вас нет прав доступа!</h1>
     <a href="../login.php">Вход</a><br>
      <a href="../index.php">HOME Page</a><br>
 <?php }?>
</div>
</body>
</html>


