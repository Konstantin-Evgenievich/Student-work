<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>База данных</title>
</head>
<body>
<div style="text-align: center;">
  <h1>
    База данных квартир
  </h1>
SELECT apartments.id, apartments.floor, apartments.square, apartments.number_of_rooms, apartments.price, district.name_district, owner.fullname from apartments JOIN district on apartments.district_id = district.id JOIN owner on apartments.owner_id = owner.id
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
    $query = "SELECT apartments.id, apartments.floor, apartments.square, apartments.number_of_rooms, apartments.price, district.name_district, owner.fullname  from apartments JOIN district on apartments.district_id = district.id JOIN owner on apartments.owner_id = owner.id  where owner.fullname = '".$search."'";

  }
  else{
    $query = "SELECT apartments.id, apartments.floor, apartments.square, apartments.number_of_rooms, apartments.price, district.name_district, owner.fullname from apartments JOIN district on apartments.district_id = district.id JOIN owner on apartments.owner_id = owner.id";


  }

  $result = mysql_query($query);

  if ($result) {?>

  <div style="text-align: center;">
    <center>
      <table border = "1">
        <tbody>
        <tr> <td>id</td><td>floor</td><td>square</td><td>number_of_rooms</td><td>price</td></td><td>name_district</td></td><td>fullname</td>
          <td>UPDATE</td><td>DELETE</td></tr>
        </tr>
        <?php while ($row = mysql_fetch_array($result)){?>

          <tr>
       <td><?=$row["id"]?></td><td><?=$row["floor"]?></td><td><?=$row["square"]?></td><td><?=$row["number_of_rooms"]?></td><td><?=$row["price"]?></td><td><?=$row["name_district"]?></td><td><?=$row["fullname"]?></td><td>
<a href="update.php?id=<?=$row['id']?>&floor=<?=$row['floor']?>&square=<?=$row['square']?>&number_of_rooms=<?=$row['number_of_rooms']?>&price=<?=$row['price']?>&district_id=<?=$row['name_district']?>&owner_id=<?=$row['fullname']?>">

                Update</a>
            </td><td><a href="delete.php?id=<?=$row['id']?>">Delete</a></td>
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
      Поиск по fullname
      <input type = "text" name = "poisk" size = 10>
      <input type = "submit" value = "Поиск">
    </div>
  </form>
  <br>
  <a href = index.php>Show All (Показать все)</a> <br>
  <a href = insert.php>Insert (Добавить)</a> <br>

</div>
</body>
</html>

