<?php
     error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
$date=date('d.m.Y');
$str = $date."\t".$_POST["name"]."\t". $_POST["message"]. "\t\r\n";
@$fp = fopen("entry.txt", "a");
fwrite($fp, $str);
$GetContentFile = file('entry.txt');
for ($n = 0; $n < count($GetContentFile); $n++)
echo $n + 1 . ')' ."\t". $GetContentFile[$n] . "<br>\r\n";
fclose($fp);
?>

