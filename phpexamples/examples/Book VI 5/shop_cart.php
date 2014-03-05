<?php
 /* Program: Shop_cart.php
  * Desc:    Manages and displays the Shopping Cart. 
  */
session_start();                                          	#5
include("dbstuff.inc");
if(!isset($_SESSION['order_number'])	
   or empty($_SESSION['order_number']))                    #8
{
   echo "Shopping Cart is currently empty<br>\n
        <a href='Shop_products.php'>Continue Shopping</a>\n";
   exit();
}
switch (@$_POST['Cart'])                                 	#14
{
   case "Continue Shopping":                             	#16
     header("Location: Shop_products.php");
     break;
   case "Update Cart":                                   	#19
     $cxn = mysqli_connect($host,$user,$passwd,$dbname);
     $order_number = $_SESSION['order_number'];
     $n = 1;
     /* Update quantities in database */  
     foreach($_POST['quantity'] as $field => $value)	#24
     {
        $sql_quant = "UPDATE OrderItem SET quantity='$value'
                      WHERE item_number= '$n' 
                      AND order_number='$order_number'";
        $result = mysqli_query($cxn,$sql_quant)
             or die("sql_quant: ".mysqli_error($cxn));
        $n++;
     }
   /* Delete any items with zero quantity */             	#33
     $sql_del = "DELETE FROM OrderItem WHERE quantity='0'	#34
                 AND order_number='$order_number'";
     $result = mysqli_query($cxn,$sql_del)
         or die("sql_del: ".mysqli_error($cxn));
   /* Renumber items in database. First, put items in an
      array. Next, delete all items from the database. Then, 
      re-insert items with new item numbers. */      
     $sql_getnew = "SELECT * from OrderItem	
                    WHERE order_number='$order_number'";
     $result = mysqli_query($cxn,$sql_getnew)
         or die("sql_getnew: ".mysqli_error($cxn));
     $n_rows = mysqli_num_rows($result);
     if($n_rows < 1)                                     	#46
     {
        echo "Shopping Cart is currently empty<br>\n
        <a href='Shop_products.php'>Continue Shopping</a>\n";
        exit();
     }
     while($row = mysqli_fetch_assoc($result))           	#52
     {
        $items_new[]=$row;
     }                                                   #55
     $sql_del2 = "DELETE FROM OrderItem
                  WHERE order_number='$order_number'";	#57
     $result = mysqli_query($cxn,$sql_del2)
         or die("sql_del2: ".mysqli_error($cxn));
     for($i=0;$i<sizeof($items_new);$i++)                	#60
     {
        $sql_ord = "INSERT INTO OrderItem
                    (order_number,item_number,catalog_number,
                     quantity,price) VALUES 
                    ($order_number,$i+1,
                      {$items_new[$i]['catalog_number']},
                      {$items_new[$i]['quantity']},
                      {$items_new[$i]['price']})";
        $result = mysqli_query($cxn,$sql_ord) 
            or die("sql_ord: ".mysqli_error($cxn));
     }                                                  	#71
     $_SESSION['n_items'] = $i;                         	#72
     include("shop_page_cart.inc");	#73
     break;
   case "Submit Order":                                 	#75
     header("Location: Shop_order.php?from=cart");
     exit();
     break;
   default:                                             	#79
      include("shop_page_cart.inc");
     break;
}
?>
