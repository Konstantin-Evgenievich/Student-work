<?php
setlocale(LC_ALL,"

ru_RU.WIN1251");
header('Content-Type: image/png');

//Создание изображения
$size_x = 800;

$size_y = 500;
$im = imagecreatetruecolor($size_x , $size_y) or die ("Cant Initialize GD");

// Создание белого фона
imagefilledrectangle($im, 0, 0, $size_x, $size_y, 0xFFFFFF);

@ $db = mysql_pconnect("localhost", "user303", "gun_centos_user_303");
if (!$db){
  echo "Error: Could not connect to database.";
  exit;
}
mysql_select_db("user303");

$query = "SELECT apartments.id, apartments.floor, apartments.square, apartments.number_of_rooms, apartments.price, district.name_district, owner.fullname from apartments JOIN district on apartments.district_id = district.id JOIN owner on apartments.owner_id = owner.id";

$query_max = "select max(price) from  apartments";

$row1 = mysql_fetch_array(mysql_query($query_max));

$max = intval($row1["max(price)"]);

$result = mysql_query($query);

$amount_of_rows = mysql_num_rows($result);

$area_for_columns = $size_x / $amount_of_rows;

$x_start = 2;

imageline ($im, 1, $size_y-30, $size_x, $size_y-30, 0x00BAFF);
imageline ($im, 1, 1, 1, $size_y-30, 0x000000);

if ($result) {
  while ($row = mysql_fetch_array($result)) {

    imagefilledrectangle ($im, $x_start, $size_y - (intval($row["price"])/$max)*($size_y-60)-31, $x_start + ($area_for_columns*3)/4, $size_y-31, 0xBAFF00);
    imagestring($im, 12, $x_start+2, $size_y - (intval($row["price"])/$max)*($size_y - 70)-60, $row["price"], 0x00BAFF);
    imagestring($im, 12, $x_start+2, $size_y - 20, $row["name_district"], 0xBA00FF);
    $x_start = $x_start + $area_for_columns;



}
}
imagepng($im);
imagedestroy($im);


// Рисование текста на изображении
//imagestring($im, 12, 0, 0, strval($amount_of_rows), 0xFFBA00);
//intval($row["price"])
?>

