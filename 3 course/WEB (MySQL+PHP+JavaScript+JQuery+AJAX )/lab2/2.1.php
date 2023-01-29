<!DOCTYPE html>
<html>
    <head>
        <title>PHP lR_2</title>
        <meta charset="utf-8">
     <?php if (isset($_COOKIE["name"] ) and isset($_COOKIE["date"]))
{
echo "Ваши данные:"  .$_COOKIE["name"]  .$_COOKIE[ "date"];
}
else
{
echo "Введите ваши данные";
}
?>

<style>
   body{
    background-color: #3366CC; /* Цвет фона веб-страницы */
   }
    </style>

<form Action = "php.php" METHOD=POST>

            
 <div><center> Введите ваше имя и дату рождения <br>
                           <br>
        
                <div><center><label for="name">Имя: </label>
                <input type="text" name="name" /></div>
            </p>
            <p> 
               <div><center> <label for="date">Дата рождения: </label>
                <input type="date" name="date" value = date/></center></div>
            </p>
               
            <p>
                <button type="submit">Отправить</button>
            </p>
         
        </form>
 <br><div><a href="../">Вернуться</a></div>
    </body>
</html>
