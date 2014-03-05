<?php
 /* File:  shop_page_products.inc
  * Desc:  Displays the products in the catalog for the
  *        selected category. 
  */
 $table_heads = array("prod_number"  => "Product Number", 
                      "name"         => "Item",
                      "description"  => "Description",
                      "price"        => "Price",
                      "pix"          => "Picture",
                      "quantity"     => "Quantity",
                     );
?>
<html>
<head><title>The Furniture Shop</title></head>
<body style='margin: .2in .2in 0'>
<?php                                                  
 echo "<form action='Shop_cart.php' method='POST'>\n
       <p style='text-align: right'>\n
       <input type='submit' name='Cart' 
                    value='View Shopping Cart'>\n
       </form>\n";                                       	#22
 echo "<h1 style='text-align: center'>The Furniture Shop</h1>
      <h2 style='size: larger'>{$_POST['interest']}</h2>\n";
echo "<p style='text-align: right'>
             ($n_products products found)\n";            #26
echo "<table style='width: 100%'>\n";
echo "<tr>\n";
 foreach($table_heads as $heading)
 {
    echo "<th>$heading</th>";
 }
 echo "</tr>\n";
 echo "<form action='$_SERVER[PHP_SELF]' method='POST'>\n";
 for($i=$n_start;$i<=$n_end;$i++)
 { 
    echo "<tr>";
    echo "<td style='padding-right: .5in; text-align: right'>
         {$products[$i]['catalog_number']}</td>\n";
    echo "<td>{$products[$i]['name']}</td>\n";
    echo "<td>{$products[$i]['description']}</td>\n";
    echo "<td style='text-align: center'>
                   \${$products[$i]['price']}</td>\n";
    echo "<td style='text-align: center'>
             <img src='images/{$products[$i]['pix']}'
                  width='55' height='60'></td>\n";       	#46
    echo "<td style='text-align: center'><input type='text'
               name='item{$products[$i]['catalog_number']}' 
               value='0' size='4'></td>\n";            	#49
    echo "</tr>";
 }
 echo "<input type='hidden' name='n_end' value='$n_end'>\n";
 echo "<input type='hidden' name='interest'
              value='$_POST[interest]'>\n";
 echo "<tr>
       <td colspan='2' style='padding: 5'> <input type='submit' 
              value='Select another category'></td>\n";
 echo "<td><input type='submit' name='Products' 	#58
                 value='Add Items to Shopping Cart'>";	      #59
 echo "<td colspan='3' style='text-align: right'>\n";
       if($n_end > $n_per_page)               
       {
          echo "<input type='submit' name='Products' 
                       value='Previous'>\n";
       }
       if($n_end < $n_products)
       {
          echo "<input type='submit' name='Products'
                 value='Next $n_per_page'>\n";
       }
 echo "</td></form></tr></table>\n";
?>
</div></body></html>
