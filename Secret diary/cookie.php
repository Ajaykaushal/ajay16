<?php 

    setcookie("CustomerId","1234",time()+60*60*24); // creates cookie
    
    setcookie("CustomerId","",time()-60*60); // destroys cookie we use (-) with time 

    echo $_COOKIE['CustomerId'];


?>