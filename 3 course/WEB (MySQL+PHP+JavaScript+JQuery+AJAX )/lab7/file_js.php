<html><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Построение  интерфейсов на базе jQuery</title>

  <script type="text/javascript" src="js/jquery-1.2.6.js"></script>
  <script type="text/javascript" src="js/jquery.form.js"></script>
  <script type="text/javascript" src="js/jquery.validate.js"></script>
  <script type="text/javascript" src="js/additional-methods.js"></script>
  <script type="text/javascript">

    $.validator.methods.equal = function(value, element, param) {
      return value == param;
    };
  </script>
</head>

<body>
<form id="myForm" action="text_js.php" method="post">
  Обработка данных форм через JavaScript JQuery
  <br><br>
  <label for="sname">Фамилия: (*)<em></em></label>
  <input type=text name="sname">
  <br>
  <label for="day">Выберете день недели: (*)<em></em></label>
  <br>
  <input type="hidden" name="day" id="day"/>
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

  <label for="list"> Выберете время:(*)<em></em></label>
  <br>
  <input type = "radio" id = "t1" name = "list" value="8:00-12:00">
  <label for="t1">8:00 - 12:00</label><br>

  <input type = "radio" id = "t2" name = "list" value="12:00-18:00">
  <label for="t2">12:00 - 18:00</label><br>

  <input type = "radio" id = "t3" name = "list" value="18:00-22:00">
  <label for="t3">18:00 - 22:00</label><br>

  <label for="Examine">1000 - 7 = (*)<em></em></label>
  <input id="Examine" name="Examine" type="text" value="" /><br />

  <input id="submit" type="submit" name="submitButton" value="Send" />
  <input type = "reset" value ="Clear">
</form>

<script type="text/javascript">
  $(document).ready(function(){
    var options = {
      target: "#output",
      url: "form.php",
      type: "post",
      success: function() {
        alert("Спасибо за комментарий!");
      },
      timeout: 3000 // тайм-аут
    };


    $("#myForm").validate({
      focusInvalid: false,
      focusCleanup: true,

      rules: {
        sname: {
          required: true,
          minlength: 2,
          maxlength: 12
        },
        day: {
          required: function (element) {
            var boxes = $('.checkbox');
            if (boxes.filter(':checked').length === 0) {
              return true;
            }
            return false;
          },
          minlength: 1
        },
        list: "required",
        Examine: {
          required: true,
          equal: 993
        }
      },

      messages: {
        sname: {
          required: "Укажите свою фамилию, пожалуйста!",
          minlength: "Не менее 2 символов",
          maxlength: "Не более 12 символов"
        },
        day: "Нужно сделать выбор!",
        list: "Нужно сделать выбор!",
        Examine: {
          required: "Надо решить этот пример!",
          equal: "Вы в школе учились?"
        }
      },

      errorPlacement: function(error, element) {
        var er = element.attr("name");
        error.appendTo( element.parent().find("label[@for='" + er + "']").find("em") );
      }

    });
  });
</script>
</body>
</html>

