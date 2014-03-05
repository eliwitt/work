<?php
echo 'localhost<br><br>';
$connection = mysql_connect("localhost", "phpsteve", "secret") or die ("Unable to connect". mysql_error());

echo 'Connected successfully<br><br>';
mysql_select_db("mysql");
$query = "select * from mysql.user";
$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error());
// see if any rows were returned 
if (mysql_num_rows($result) > 0) { 
    // yes 
    // print them one after another 
    echo "<table cellpadding=10 border=1>"; 
    while($row = mysql_fetch_row($result)) { 
        echo "<tr>"; 
        echo "<td>".$row[0]."</td>"; 
        echo "<td>" . $row[1]."</td>"; 
        echo "<td>".$row[2]."</td>"; 
        echo "</tr>"; 
    } 
    echo "</table>"; 
} 
else { 
    // no 
    // print status message 
    echo "No rows found!"; 
} 

// free result set memory 
mysql_free_result($result); 

// close connection 
mysql_close($connection); 
?>