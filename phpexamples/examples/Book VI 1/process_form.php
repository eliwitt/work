<?php
/*  Script name:  process_form.php (1-1)
 *  Description:  Script displays all the information
 *                passed from a form.
 */
  echo "<html>
        <head><title>Form Fields</title></head>
        <body>";
  echo "<ol>";
  foreach($_POST as $field => $value)
  {
     echo "<li> $field = $value</li>";
  }
  echo "</ol>";
?>
</body></html>
