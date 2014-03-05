<?php
/*  Program name: login_url.php
 *  Description:  Logs in user.
 */
 if(isset($_POST['sent']) && $_POST['sent'] == "yes")	    #5
 {
   /* check each field for blank fields */
  foreach($_POST as $field => $value)	                    #8
  {
    if($value == "")
    {
      $blank_array[$field] = $value;
    } 
    else
    {
      $good_data[$field]=strip_tags(trim($value));
    }
  }  // end of foreach loop for $_POST
  if(@sizeof($blank_array) > 0) // blank fields found  	 #19
  {
    $message = "<p style='color: red; margin-bottom: 0; 
                         font-weight: bold'>
          You must enter both a user id and a password.</p>";
    /* redisplay form */
    extract($blank_array);	                              #25
    extract($good_data);
    include("form_log.inc");
    exit();
  } // end if blanks found	                              #29
  include("dbstuff.inc");	                               #30
  $cxn = mysqli_connect($host,$user,$passwd,$dbname)
            or die ("couldn't connect to server");
  $query = "SELECT first_name FROM Name2 
                   WHERE user_name='$_POST[user_name]' 
                   AND password=md5('$_POST[password]')";
  $result = mysqli_query($cxn,$query)
            or die ("Couldn't execute query.");
  $n_row = mysqli_num_rows($result);
  if($n_row < 1) // if login unsuccessful	               #39
  {
    $message = "<p style='color: red; margin-bottom: 0; 
                   font-weight: bold'>
                   User ID and Password not found.</p>";
    extract($_POST);
    include("form_log.inc");
    exit();
  }
  else //if login successful	                           #48
  {
    $row=mysqli_fetch_assoc($result);
    header("Location: secret_page_url.php?first_name=
                      $row[first_name]");
  }
 } // end if submitted	                                  #54
 else // first time script is run	                       #55
 {
   $user_name = "";
   $password = "";
   include("form_log.inc");
 }
?>
