<?php
/*  Program name: secret_page_cookie.php
 *  Description:  Displays a welcome page.
 */
  if($_COOKIE['auth'] != "yes")
  {
      header("Location: login_cookie.php");
      exit();
  } 
  echo "<html>
        <head><title>Secret Page with Cookie</title></head>
        <body>";
  echo "<p style='text-align: center; margin: .5in'>
           Hello, {$_COOKIE['first_name']}<br />
           Welcome to the secret page</p>";
?>
</body></html>
