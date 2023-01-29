<!DOCTYPE html>
<html lang="en">
<head>
  <script type="text/javascript" src="ckeditor/build/ckeditor.js"></script>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Title</title>
</head>

<body>
<form action="text.php" method="post">

  <textarea name="content" id="editor">
        <p>Write smth there</p>
    </textarea>
  <br>
  Выберете день недели:
  <br>
  <input type = "checkbox" name="mon" checked value = "Понельник">
  Понедельник
  <br>
  <input type = "checkbox" name="tue" value = "Вторник">
  Вторник
  <br>
  <input type = "checkbox" name="wen" value = "Среда">
  Среда
  <br>
  <input type = "checkbox" name="th" value = "Четверг">
  Четверг
  <br>
  <input type = "checkbox" name="fr" value = "Пятница">
  Пятница
  <br>
  <input type = "checkbox" name="st" value = "Суббота">
  Суббота
  <br>
  <input type = "checkbox" name="sn" value = "Воскресенье">
  Воскресенье
  <br>
  <select name = "list">
    <option value = "8:00 - 12:00">8:00 - 12:00</option>
    <option value = "12:00 - 18:00">12:00 - 18:00</option>
    <option value = "18:00 - 22:00">18:00 - 22:00</option>
  </select>

  <input type = "reset" value ="Clear">

  <h2>Введите капчу</h2>

  <div name="captcha"><img src="captcha.php"/></div>

  <div name="inp"><input class="input" type="text" name="captcha_text" /> </div>

  <input type="submit" value="Send">
</form>
<script type="text/javascript" src="ckeditor/build/ckeditor.js"></script>
<script>
  ClassicEditor
    .create(document.getElementById('editor'))
    .then( editor => {
      window.editor = editor;
    } )
    .catch( error => {
      console.error( 'Oops, something went wrong!' );
      console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
      console.warn( 'Build id: xlw6pkomvuxf-hlpjt82ha62y' );
      console.error( error );
    } );
</script>
</body>
</html>
