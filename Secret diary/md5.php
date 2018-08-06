<?php 
// 1 level is doing nothing
// 2 level is md5



 echo md5("password");
// to make it more hard or secure we take a long dificult string and add to password
//4level is adding salt
$salt = "kjfhdshfshhfouh35454h43th437t";
echo"<br>";

echo md5($salt."password");
// It is also not secure because hacker can guess the salt and can decript passwords of user
// now 4 level encryption
// in this level we will add row id as a salt

echo "<br>";

$row['id']=76;

echo md5(md5($row['id'])."password");


?>