<?php
 /*File:   shop_page_cart.inc
  *Desc:   Defines the HTML page that displays the shopping 
  *        cart. The items are displayed in a table owith
  *        prices. Quantities can be changed. 
  */
include("dbstuff.inc");	#7
$table_headers = array( "Item","Cat No","Furniture",
                        "Amount","Price","Total");
$order_number = $_SESSION['order_number'];              	#10
$table_name = $order_number;	#11
$cxn = mysqli_connect($host,$user,$passwd,$dbname);	   #12
$sql_1 = "SELECT * FROM OrderItem 
          WHERE order_number='$order_number'";
$result = mysqli_query($cxn,$sql_1)
    or die("sql_1: ".mysqli_error($cxn));
$n_row = mysqli_num_rows($result);	                      #17
if($n_row < 1)                                          	#18
{
   echo "Shopping Cart is currently empty<br>\n
      <a href='Shop_products.php'>Continue Shopping</a>\n";
   exit();
}
$n=1;                                                   	#24
while($row = mysqli_fetch_assoc($result))               	#25
{
   foreach($row as $field => $value)
   {
      if($field != "order_number")
      {
         $items[$n][$field]=$value;
         if($field == "catalog_number")
         {
            $sql_2 = "SELECT name,type FROM furniture WHERE
                  catalog_number = '$row[catalog_number]'";
            $result2 = mysqli_query($cxn,$sql_2)
                or die("sql_2: ".mysqli_error($cxn));
            $row = mysqli_fetch_row($result2);
            $items[$n]["name"]=$row[0]." ".$row[1];
         } 
      }
   }
   $n++;
}                                                         #44
echo "<html>
      <head><title>Furniture Shopping Cart</title></head>\n
      <body>\n";
echo "<h1 style='text-align: center'>The 
                                Furniture Shop</h1>\n";
echo "<h2 style='text-align: center'>Shopping Cart</h2>\n";
echo "<p style='font-weight: bold'>
                Order Number: $table_name<hr>\n";
echo "<table border = '0' style='width: 100%'>\n";
echo "<form action='$_SERVER[PHP_SELF]' method='POST'>";	#54
echo "<tr>";
foreach($table_headers as $header)                      	#56
{
   echo "<th>$header</th>\n";
}
echo "</tr>";
echo "<tr><td colspan='6'><hr></td></tr>\n";
for($i=1;$i<=sizeof($items);$i++)                       	#62
{
   echo "<tr>";
   echo "<td style='width: 10%'>
           {$items[$i]['item_number']}\n";
   echo "<td style='width: 10%'>
           {$items[$i]['catalog_number']}\n";
   echo "<td >{$items[$i]['name']}\n";
   echo "<td style='text-align: center; width: 20%'>
            <input type='text' name='quantity[]' 
                   value='{$items[$i]['quantity']}' 
                   size='4'></td>\n";
   $f_price = number_format($items[$i]['price'],2);
   echo "<td style='text-align: right; width: 17%'>
              $$f_price</td>\n";
   $total=$items[$i]['quantity'] * $items[$i]['price'];	 #77
   $f_total = number_format($total,2);
   echo "<td style='text-align: right'>$$f_total</td></tr>";
   @$order_total = $order_total + $total;
}
$f_order_total = number_format($order_total,2);         	#82
?>
<tr><td colspan='5' 	
    style='text-align: right; font-weight: bold'>Total</td>
    <td style='text-align: right; line-height: 200%'> $ 
        <?php echo $f_order_total ?></td></tr>
  <input type='hidden' name='order_number' 
        value='<?php echo $order_number ?>'>
<tr><td colspan='2' style='text-align: left'>	
  <input type='submit' name='Cart' 
        value='Continue Shopping'></td>
<td colspan='2' style='text-align: center'>
  <input type='submit' name='Cart' 
               value='Submit Order'></td>
<td colspan='2' style='text-align: right'>
  <input type='submit' name='Cart' value='Update Cart'></td>
</tr></table></form></body></html>
