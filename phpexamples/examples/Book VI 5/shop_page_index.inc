<?php
  /* File:  shop_page_index.inc
   * Desc:  Displays the categories for the catalog.
   */
?>
<html>
<head><title>The Furniture Shop</title>
     <style type='text/css'>
       <!--
       ul li {
         list-style: none; 
         font-weight: bold; 
         padding-top: .5em;
         font-size: 1.2em;
         }
       ul li.level2 {
         margin-left: -1em;
         font-weight: normal;
         font-size: .9em;
         }
        -->
     </style>
</head>  
<body style="margin: .2in">
<?php
  /* Display text before form */
 echo "<form action='Shop_cart.php' method='POST'>\n
       <p style='text-align: right'>\n
       <input type='submit' value='View Shopping Cart'>\n
       </form>\n";	                                       #30
echo "<h1 style='text-align: center'>The Furniture Shop</h1>
       <hr>";
 /* Create form containing selection list */
 echo "<form action='$_SERVER[PHP_SELF]' method='POST'>\n";
 echo "<ul>\n"; 
 foreach($furn_categories  as $key => $subarray)         #36
 {
    echo "<li>$key</li>\n";                              #38
    echo "<ul>\n";                                       #39
    foreach($subarray as $type)                          #40
    {
      echo "<li class='level2'>
              <input type='radio' name='interest' 
                     id='$type' value='$type'>
              <label for='$type'>$type</label></li>\n";  #45
    } // end foreach type
    echo "</ul>\n";
 } //end foreach category
 echo "</ul>";                                           #49
 echo "<input type='submit' name='Products' 
       value='Select Category' style='margin-left: .5in'>\n";
 echo "</form>\n";                                       #52
?>
<hr>
</body></html>
