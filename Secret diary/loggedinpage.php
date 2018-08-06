<?php 
$link= mysqli_connect("localhost","root","","secret diary");
session_start();
if (isset($_SESSION['id'])) {

    // it does; output the message
    //echo $_SESSION['id'];
    $id = $_SESSION['id'];
}


if(array_key_exists("id",$_COOKIE)){
    
    $_SESSION['id']=$_COOKIE['id'];
}

if(array_key_exists("id",$_SESSION)){
    
    
    echo "<p>logged in! <a href= 'secret.php?logout=1'> Log out</a></p>";
} else {
    
    header("Location: secret.php");
}

include("header.php");
//echo"$yaddu";

extract($_POST);
if(isset($submitdb))
{
    if($secretarea==""){
        
        echo"Enter some thing to save";
    }else{
    $msg="<pre>$secretarea</pre>";
    $query="insert into textarea (id,secret) values('$id','$msg')";
    $result = mysqli_query($link,$query);
    }
}



?>
<form class="container-fluid" method="post">

    <div style="color:White;font-size:150%; ">New Secret :</div>
   <textarea style=""rows="5" cols="100" name="secretarea"></textarea>
    <br>
    <br>
    <input type="submit" class=" btn btn-success " id ="submitdb" name="submitdb" value="Save">

        </form>

<form method="post"> 
      <h1 style="color:Black;"> Want to see Your Previous Secrets :     </h1>  <input type="submit" class="btn btn-success" id="showdb" name="showdb" value=" Show">
</form>
<?php

if(isset($showdb))
{
    $temp = $_SESSION['id'];
    $query="select date,secret from textarea where id = $temp " ;
//    $query= "'SELECT date,secret FROM textarea WHERE id='".mysqli_real_escape_string($link,$_SESSION['id'])."'";
	$result=mysqli_query($link,$query);
	echo "<table border=1>";
	echo "<tr><th>Email</th><th>Message</th></tr>";
	while($row=$result->fetch_array())
		{
		echo "<tr>";
		echo "<td>".$row['date']."</td>";
		echo "<td>".$row['secret']."</td>";
		echo "</tr>";
		}
	echo "</table>";	
}
?>


<?php
include("footer.php");

?>