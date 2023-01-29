<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<title>ЛР №8!</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="jquery-1.2.6.js"></script>
<script type="text/javascript">
var i=0; 
var elem = new Array();
jQuery(document).ready(function(){
jQuery('#type').change(function(){
value=$("select[@id=type] option:selected").val();
//alert(value);
$('select[@name=data] option').remove();
if(value==0)  {$('select[@name=data]').append('<option value='+0+'>Выберите таблицу выше</option>');}
$.getJSON("select.php?type="+value, function(datta){
var i;
for(i in datta) {
//alert(datta[i]);
$('select[@name=data]').append('<option value='+i+'>'+datta[i]+'</option>');
//document.getElementById(i).innerHTML='<option value='+i+'>'+datta[i]+'</option>';
//i++;
};
});
});
    //jQuery('#example-1').click(function(){
//value=$("select[@id=example-1] option:selected").val();
//                alert(value);
//               })
});
-->
</script>
</head>
<body>
<form name=myFormId method=GET action=select.php>
Выберите таблицу:</div><select id="type" name="type">
<option value=0>
<option value=1>Цена
<option value=2>Пол
</select>
<P>Данные:<select name="data" width=40>
<option>Выберите таблицу выше</option>
</select>
<P><input type=submit>
</form>
<P>
</body>