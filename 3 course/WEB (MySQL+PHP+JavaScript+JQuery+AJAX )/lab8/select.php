<?php
function array_to_json( $array ){

if( !is_array( $array ) ){
return false;
}

$associative = count( array_diff( array_keys($array), array_keys( array_keys( $array )) ));
if( $associative ){

$construct = array();
foreach( $array as $key => $value ){

// We first copy each key/value pair into a staging array,
// formatting each key and value properly as we go.

// Format the key:
if( is_numeric($key) ){
$key = "key_$key";
}
$key = "'".addslashes($key)."'";

// Format the value:
if( is_array( $value )){
$value = array_to_json( $value );
} else if( !is_numeric( $value ) || is_string( $value ) ){
$value = '"'.addslashes($value).'"';
}

// Add to staging array:
$construct[] = "$key: $value";
}

// Then we collapse the staging array into the JSON form:
$result = "{ " . implode( ", ", $construct ) . " }";

} else { // If the array is a vector (not associative):

$construct = array();
foreach( $array as $value ){

// Format the value:
if( is_array( $value )){
$value = array_to_json( $value );
} else if( !is_numeric( $value ) || is_string( $value ) ){
$value = "'".addslashes($value)."'";
}

// Add to staging array:
$construct[] = $value;
}

// Then we collapse the staging array into the JSON form:
$result = "[ " . implode( ", ", $construct ) . " ]";
}

return $result;
}

if (isset($_REQUEST['type'])){

@$cn=mysql_connect('localhost','user303','gun_centos_user_303');
if(!$cn){echo "Can't connect to database!";exit;}
@$db=mysql_select_db("user303");
if(!$db){echo "Can't change database!";exit;}

if($_GET['type']==1){
//SELECT apartments.id, district.name_district from apartments JOIN district on apartments.district_id = district.id


$SQL="SELECT apartments.id, apartments.price from apartments";
$query = mysql_query($SQL);

$id = array();
$name = array();

$nr=mysql_num_rows($query);

while($row = mysql_fetch_array($query))
{
$id[] = $row['id'];
$name[] = $row['price'];
}

echo array_to_json(array($id[0] => $name[0],$id[1] => $name[1],$id[2] => $name[2],$id[3] => $name[3],$id[4] => $name[4],$id[5] => $name[5],$id[6] => $name[6],$id[7] => $name[7]));


}

if($_GET['type']==2){

$SQL="select id, types_of_floors from floor";
$query = mysql_query($SQL);

$id = array();
$name = array();

$nr=mysql_num_rows($query);

while($row = mysql_fetch_array($query))
{
$id[] = $row['id'];
$name[] = $row['types_of_floors'];
}

echo array_to_json(array($id[0] => $name[0],$id[1] => $name[1],$id[2] => $name[2],$id[3] => $name[3],$id[4] => $name[4]));
}

}
?>

