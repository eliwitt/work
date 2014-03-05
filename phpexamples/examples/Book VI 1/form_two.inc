<?php
/*  Program name: form_two.inc
 *  Description:  Displays a form with two buttons.
 */
?>
<html>
<head><title>Two Buttons</title></head>
<body>
<?php
echo "<form action='$_SERVER[PHP_SELF]' method='POST'>
        <p><label for='last_name' 
              style='font-weight: bold'>Name: </label></p>
        <p><input id='last_name' name='last_name' type='text' 
             size='50%' maxlength='65' /></p>
        <p><input type='submit' name='display_button' 
                value='Show Address' />
        <input type='submit' name='display_button' 
                value='Show Phone Number' /></p>
        <input type='hidden' name='sent' value='yes' />
      </form>";
?>
</body></html>
