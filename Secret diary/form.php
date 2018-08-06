<?php 

    session_start();

    

if(array_key_exists('email',$_POST) OR array_key_exists('password',$_POST)){
    



$link= mysqli_connect("localhost","root","","users");
  
 if (mysqli_connect_error()) {
     
     die ("There was an error connecting to the database");
 }

if($_POST['email']==""){
    
    echo"<p> Email address is required </p>";
} else if($_POST['password']==""){
    
    echo"<p> Password is required </p>";
} else {
    
    
    $query="SELECT id FROM user WHERE email ='".mysqli_real_escape_string($link,$_POST['email'])."'";
    
    // mysqli_real_escape_string is used because we are concatinating email and for security issue this is used  so that no one can change or put malcious data from email .
                                                                                                    
    $result = mysqli_query($link,$query);
    
    $rowcount=mysqli_num_rows($result); // this is counting the no. of rows containig same email
    
    printf("Result set has %d rows.\n",$rowcount);   // This is showing the result 
    
    if($rowcount >0){
  
   echo "<p> That email address is already been taken </p>";
        
    } else {
        
        $query ="INSERT INTO `user`(`email`,`password`) VALUES('".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link,$_POST['password'])."')";
        
        if( mysqli_query($link,$query)){
            
        $_SESSION['email']=$_POST['email'];
            
            header("Location: http://localhost/mysql/session.php");
            
        } else {
            
            echo "<p> There was a problem in signing you up - Please try again later.</p>";
        }
    }
}
 
}


?>

<form method="post">

<input name="email" placeholder="Email Address" type="text">
    
    <input name="password" placeholder="Password" type="password">
    <input type="submit" value="Sign Up!">
    
</form>