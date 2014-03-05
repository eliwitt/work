<?php
/*  Program name: form_log.inc
 *  Description:  Displays a login form.
 */
  if(isset($message))
  {
    echo $message;
  }
  echo "<form action='$_SERVER[PHP_SELF]'
              method='POST' style='margin: .5in'>\n
    <p><label for='user_name' style='font-weight: bold;
              padding-bottom: 1em'>User ID: </label>
       <input type='text' name='user_name' id='user_name'
              value='$user_name' />\n</p>
    <p><label for='password' style='
              font-weight: bold'>Password: </label>
       <input type='password' name='password' id='password'
              value='$password' />\n</p>
    <p><input type='submit' value='Log in'>\n</p>
       <input type='hidden' name='sent' value='yes' />
    </form>\n";
?>
