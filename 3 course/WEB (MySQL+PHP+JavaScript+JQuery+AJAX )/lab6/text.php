<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
if ($_POST['captcha_text'] != $_SESSION['captcha'])
{?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
</head>

<body><center><h1>Вы ввели неверную капчу</h1>
<p><a href="javascript:history.go(-1)">Исправить</a></p></body></html>

  <?php
}
else {
  unset($_SESSION['captcha']);
error_reporting(E_ERROR|E_PARSE);
$date = date("d.m.Y");
$str = $date."\t".$_POST["mon"]." ".$_POST["tue"]." ".$_POST["wen"]." ".$_POST["th"]." ".$_POST["fr"]." ".$_POST["st"]." ".$_POST["sn"]." ".$_POST["list"].$_POST["content"]."<br>";

$fp = fopen("file.txt", "a");
flock($fp, 2);
if (!$fp)
{
  echo "Ваша анкета не может быть обработана сейчас!";
  exit;
}

fwrite($fp, $str);
fclose($fp);

$file = file_get_contents('file.txt');
echo $file;
?>
<br>
<a href="index.php">Добавить данные</a>
<?php }?>
</body>
</html>
