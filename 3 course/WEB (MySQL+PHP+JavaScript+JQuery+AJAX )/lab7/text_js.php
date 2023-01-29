
<?php
error_reporting(E_ERROR|E_PARSE);
$date = date("d.m.Y");
$str = $date."\t".$_POST["sname"]." ".$_POST["mon"]." ".$_POST["tue"]." ".$_POST["wen"]." ".$_POST["th"]." ".$_POST["fr"]." ".$_POST["st"]." ".$_POST["sn"]." ".$_POST["list"]."<br>";

$fp = fopen("file.txt", "a");
flock($fp, 2);
if (!$fp)
{
  echo "Ваша анкета не может быть обработана сейчас!";
  exit;
}

fwrite($fp, $str);
fclose($fp);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Title</title>
</head>
<body>
<?php
$file = file_get_contents('file.txt');
echo $file;
?>
</body>
</html>
