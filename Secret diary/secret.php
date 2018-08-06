 <?php

session_start();

$error=""; 

if(array_key_exists("logout",$_GET)){

    //unset($_SESSION);
    session_destroy();
    setcookie("id","",time()-60*60);
    $_COOKIE["id"]="";
} else if ((array_key_exists("id",$_SESSION) AND $_SESSION['id']) OR (array_key_exists("id",$_COOKIE) AND $_COOKIE['id'])){
    
    header("Location:loggedinpage.php");
}

if(array_key_exists("submit",$_POST)){
    
 include("connection.php"); 

    
     if($_POST['email']==""){
    
    $error.="<p> Email address is required </p>";
} 
    if($_POST['password']==""){
    
    $error.="<p> Password is required </p>";
}
    if($error !=""){

        $error= "<p> There were errors in your form </p>".$error ;

    } else {
        if($_POST['signUp']=='1'){ 
            
        $query = "SELECT id FROM users WHERE email='".mysqli_real_escape_string($link,$_POST['email'])."'LIMIT 1";
        
        $result= mysqli_query($link,$query);
        
        if(mysqli_num_rows($result)>0){
      
            $error = "That email address is taken.";
        }else{
            
            $query= "INSERT INTO users (email,password) VALUES('".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link,$_POST['password'])."')";
            
           if(! mysqli_query($link,$query)) {
                
                $error ="Could not sign you up!";
            }else{

   // $query="UPDATE users SET password='".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE email = 'ashu@ashu.com' LIMIT 1";
               
     $query="UPDATE `users` SET password='".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id =".mysqli_insert_id($link);
                 
               mysqli_query($link,$query);
               
               $_SESSION['id']=mysqli_insert_id($link);
               
               if($_POST['stayLoggedIn']=='1'){

               setcookie("id",mysqli_insert_id($link),time()+ 60*60*24*365);
                   
               }
               
          header("Location:loggedinpage.php");
           
           }           
            
        }
    } else{
            
            $query="SELECT * FROM users WHERE email ='".mysqli_real_escape_string($link,$_POST['email'])."'";
            $result = mysqli_query($link,$query);
            
            $row= mysqli_fetch_array($result);
            
           // if(array_key_exists("id",$row)){
                if(isset($row)){
                
                $hashedpassword=md5(md5($row['id']).$_POST['password']);
                if($hashedpassword==$row['password']){
                    
                    $_SESSION['id']=$row['id'];
                      
                    if($_POST['stayLoggedIn']=='1'){
                        setcookie("id",$row['id'],time()+60*60*24*365);
                    }
                    
                    header("Location:loggedinpage.php");
                    
                }else {
                    
                    $error="Email/Password combination does not match";
                } 
                
            }else {
                    
                    $error="Email/Password combination does not match";
                } 
            
        }
        
    }
    
}


?>
<?php include("header.php");?>

      
      <div class="container" id="homePageContainer">
          
    <h1>Secret Diary!</h1>

    <p><strong>Store your thoughts permanently and securely.</strong></p>     
          
<div id ="error"> <?php echo $error; ?></div>
          
<form method="post" id="signUpForm">
    
    <p>Interested ? Sign Up NOW !</p>
   
    <fieldset class="form-group">
         
         <input name="name" class="form-control" placeholder="Name" type="text">
    
    </fieldset>
   
     <fieldset class="form-group">

         <input name="email" class="form-control" placeholder="Email Address" type="text">

     </fieldset>
    
     <fieldset class="form-group">
         
         <input name="password" class="form-control" placeholder="Password" type="password">
    
    </fieldset>
    
    <fieldset class="form-group">
         
         <input name="city" class="form-control" placeholder="City" type="text">
    
    </fieldset>
    
    <fieldset class="form-group">
         
         <input name="phone" class="form-control" placeholder="Phone Number" type="text">
    
    </fieldset>
    
    <fieldset class="form-group">
         
         <input name="age" class="form-control" placeholder="Age" type="text">
    
    </fieldset>
    
    
    
     <div class="checkbox">
         
         <label>
             
            <input type="checkbox" name="stayLoggedIn" value="1"> Stay logged in
         </label>
         
     </div>
    
     <fieldset class="form-group">
         
         <input type="hidden" name="signUp" value="1">
    
         <input type="submit" class="btn btn-success"name="submit" value="Sign Up!">
    
     </fieldset>
    
    <p> <a  class="toggleForms"> Log In!</a></p>

</form>

<form method="post" id="logInForm">
    
    <p>Log in using your username and password.</p>

     <fieldset class="form-group">
         
         <input name="email" class="form-control"  placeholder="Email Address" type="text">
    
    </fieldset>
    
     <fieldset class="form-group">
    
        <input name="password" class="form-control" placeholder="Password" type="password">
         
    </fieldset>
    
     <div class="checkbox">
         
         <label>
             
             <input type="checkbox" name="stayLoggedIn" value="1"> Stay logged in
             
         </label>
         
    </div>
    
     <fieldset class="form-group">
    
         <input type="hidden" name="signUp" value="0">
    
         <input type="submit" class="btn btn-success" name="submit" value="Log In!">
         
    </fieldset>
    
        <p> <a  class="toggleForms">Sign Up !</a></p>
    
</form>
    </div>      
  <?php include("footer.php");?>