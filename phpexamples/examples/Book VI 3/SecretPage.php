<?php
 /* File: SecretPage.php
  * Desc: Displays a welcome page when the user 
  *       successfully logs in or registers.
  */
   session_start();	                                       #6
   if(@$_SESSION['auth'] != "yes")	                        #7
   {
      header("Location: Login_reg.php");
      exit();
   }	                                                     #11
   echo "<head><title>Secret Page</title></head>
         <body>";
   echo "<p style='text-align: center; font-size: 1.5em; 
            font-weight: bold; margin-top: 1em'>
            The User ID, {$_SESSION['logname']}, has 
            successfully logged in</p>";
?>
</body></html>
