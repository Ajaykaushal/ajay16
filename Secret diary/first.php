<?php
$link= mysqli_connect("localhost","root","","users");
  
 if (mysqli_connect_error()) {
     
     die ("There was an error connecting to the database");
 }

//$query="SELECT * FROM user";

//if ($result = mysqli_query($link,$query)){
    
   // $row= mysqli_fetch_array($result);
    
   // print_r($row);
//}
//
$query= "INSERT INTO user(`Email`,`Password`) VALUES('YAsDVENDRAK01@GMAIL.COM', 'HIs@BRO')";
//
mysqli_query($link,$query);
     
$query="UPDATE `user` SET Password='nopass' WHERE email='YADVENDRAK01@GMAIL.COM' LIMIT 1";
 
mysqli_query($link,$query);


?>