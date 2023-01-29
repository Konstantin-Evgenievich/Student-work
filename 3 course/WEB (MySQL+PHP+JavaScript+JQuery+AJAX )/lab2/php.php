<?php
setcookie("name", $_POST["name"], time() + 3600, '/');
setcookie("date", $_POST["date"], time() + 3600, '/');
header("location:2.1.php");
exit();
?>

