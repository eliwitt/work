<?php
/*  Program name: processTwoButtons.php
 *  Description:  Displays different information depending
 *                on which submit button was clicked.
 */
 if(isset($_POST['sent']) && $_POST['sent'] == "yes")	   #6
 {
   include("dbstuff.inc");
   $cxn = mysqli_connect($host,$user,$passwd,$dbname)
         or die ("Couldn't connect to server");
   if($_POST['display_button'] == "Show Address")
   {
     $query = "SELECT street,city,state,zip FROM Customer 
                 WHERE last_name='$_POST[last_name]'";
     $result = mysqli_query($cxn,$query)
               or die ("Couldn't execute query.");
     $row = mysqli_fetch_assoc($result);
     extract($row);
     echo "$street<br />$city, $state  $zip";
  }
  else
  {
     $query = "SELECT phone FROM Customer 
                   WHERE last_name='$_POST[last_name]'";
     $result = mysqli_query($cxn,$query)
               or die ("Couldn't execute query.");
     $row = mysqli_fetch_assoc($result);
     echo "Phone: {$row['phone']}";
  }
 }
 else
 {
   include("form_two.inc");
 }
?>
