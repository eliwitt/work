<?php
/*  Program name: secret_page_url.php
 *  Description:  Displays a welcome page.
 */
?>
<html>
<head><title>Secret Page with GET</title></head>
<body>
<?php
   echo "<p style='text-align: center; margin: .5in'>
           Hello, {$_GET['first_name']}<br />
           Welcome to the secret page</p>";
?>
</body></html>
