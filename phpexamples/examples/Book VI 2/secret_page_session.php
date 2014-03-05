<?php
/*  Program name: secret_page_cookie.php
 *  Description:  Displays a welcome page.
 */
 session_start();
 if($_SESSION['auth'] != "yes")
  {
      header("Location: login_session.php");
      exit();
  } 
  echo "<html>
        <head><title>Secret Page with Session</title></head>
        <body>";
  echo "<p style='text-align: center; margin: .5in'>
           Hello, {$_SESSION['first_name']}<br />
           Welcome to the secret page</p>";
?>
</body></html>
