<html> 
<head> 
<basefont face="Arial"> 
</head> 
<body> 

<?php 

// set database server access variables: 
$host = "localhost"; 
$user = "sa"; 
$pass = "adaptivesql"; 
$db = "myTDDdb"; 

$conn = new COM ("ADODB.Connection")
  or die("Cannot start ADO");
//define connection string, specify database driver
$connStr = "PROVIDER=SQLOLEDB;SERVER=".$host.";UID=".$user.";PWD=".$pass.";DATABASE=".$db; 
$conn->open($connStr); //Open the connection to the database
//declare the SQL statement that will query the database
$query = "SELECT * FROM symbols";
//execute the SQL statement and return records
$result = $conn->execute($query);

// see if any rows were returned 
if ($result->Fields->Count() > 0) { 
    // yes 
    // print them one after another 
    echo "<table cellpadding=10 border=1>"; 
    while(!$result->EOF) { 
        echo "<tr>"; 
        echo "<td>".$result->Fields->Item("id")."</td>"; 
        echo "<td>" .$result->Fields->Item("country")."</td>"; 
        echo "<td>".$result->Fields->Item("animal")."</td>"; 
        echo "</tr>"; 
		$result->MoveNext(); //move on to the next record
    } 
    echo "</table>"; 
} 
else { 
    // no 
    // print status message 
    echo "No rows found!"; 
} 
//close the connection and recordset objects freeing up resources 
$result->Close();
$conn->Close();

$result = null;
$conn = null;
?> 
</body>
</html>