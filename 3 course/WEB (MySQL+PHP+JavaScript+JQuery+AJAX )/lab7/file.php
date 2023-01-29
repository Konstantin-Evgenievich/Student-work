<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Title</title>

  <script language="JavaScript">

    function OpenWin(name) {
      str = "&nbsp;";
      myWin1 = window.open("", "TestWindow", "width=500, height=400, status=no, toolbar=no, resizable=yes, scrollbars=no, menubar=no");
      myWin1.document.write("<head>")
      myWin1.document.write("<meta http-equiv=Content-Type content=text/html; charset=UTF-8>")
      myWin1.document.write("<script>");
      myWin1.document.write("function send(){");
      myWin1.document.write("cs.submit();");
      myWin1.document.write("}<\/script></head><body>");

      myWin1.document.write("<form name='cs' method='post' action='text.php'>");

      myWin1.document.write("<br>Surname=");
      myWin1.document.write("<input type=text name=surname value=");
      surname = parent.ss.sname.value;
      myWin1.document.write(surname);
      myWin1.document.write(">");

      var day = "";
      var checkboxes = parent.ss.getElementsByClassName('checkbox');
      for (var index = 0; index < checkboxes.length; index++) {
        if (checkboxes[index].checked) {
          day = day + checkboxes[index].value + str;
        }
      }

      myWin1.document.write("<br>Day=");
      myWin1.document.write("<input type=text name=day value=");
      myWin1.document.write(day);
      myWin1.document.write(">");

      myWin1.document.write("<br>Time=");
      myWin1.document.write("<input type=text name=time value=");
      time = parent.ss.list.value;
      myWin1.document.write(time);
      myWin1.document.write(">");

      if (surname !== "" && day !== "" && time !== "") {
        myWin1.document.write("<br><input type=button value='Отправить' onclick=send();>");
      }
      else {
        if (surname === "")
          alert("Не указана фамилия!");
        if (day === "")
          alert("Не указан день!");
        if (time === "")
          alert("Не указано время!");

        myWin1.focus();
        myWin1.document.write("<br><input type=button value='Исправить' onclick='self.close();'");
      }
      myWin1.document.write("</form></body>");
    }
  </script>
</head>
<body>
<form name = "ss">
  Обработка данных форм через JavaScript
  <br>Фамилия<br>
  <input type=text name="sname">
  <br>
  Выберете день недели:
  <br>
  <input class="checkbox" type = "checkbox" name="mon" value = "Понельник">
  Понедельник
  <br>
  <input class="checkbox" type = "checkbox" name="tue" value = "Вторник">
  Вторник
  <br>
  <input class="checkbox" type = "checkbox" name="wen" value = "Среда">
  Среда
  <br>
  <input class="checkbox" type = "checkbox" name="th" value = "Четверг">
  Четверг
  <br>
  <input class="checkbox" type = "checkbox" name="fr" value = "Пятница">
  Пятница
  <br>
  <input class="checkbox" type = "checkbox" name="st" value = "Суббота">
  Суббота
  <br>
  <input class="checkbox" type = "checkbox" name="sn" value = "Воскресенье">
  Воскресенье
  <br>
  <br>

  Выберете время
  <br>
  <input type = "radio" id = "t1" name = "list" value="8:00-12:00">
  <label for="t1">8:00 - 12:00</label><br>

  <input type = "radio" id = "t2" name = "list" value="12:00-18:00">
  <label for="t2">12:00 - 18:00</label><br>

  <input type = "radio" id = "t3" name = "list" value="18:00-22:00">
  <label for="t3">18:00 - 22:00</label><br>

  <input type="button" value="Send" onClick="OpenWin()">
  <input type = "reset" value ="Clear">
</form>

</body>
</html>
