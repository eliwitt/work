<html>
<head>
<!-- RDS Control -->
<object classid="clsid:BD96C556-65A3-11D0-983A-00C04FC29E33" ID="SControl" WIDTH="1" HEIGHT="1">
	<param NAME="SERVER" VALUE="http://<%=Request.ServerVariables("SERVER_NAME")%>">	
</object>

<title>RDS Listing</title>
</head>

<body language="VBScript" onload="Load">
<h1 align="center">&nbsp;</h1>
<h1 align="center">
<table border="0" cellPadding="1" cellSpacing="1" height="80" style="HEIGHT: 80px; LEFT: 106px; POSITION: absolute; TOP: 20px; WIDTH: 308px; Z-INDEX: 102" width="48.58%">
    
    <tr>
        <td><strong><font size="6">Mastering Web Dev</font></strong></td>
    </tr>
</table>
</h1>

<h1 align="center">&nbsp;</h1>
<h1 align="center"><font color="#160b5a">
<table border="0" cellPadding="1" cellSpacing="1" height="56" style="HEIGHT: 56px; LEFT: 23px; POSITION: absolute; TOP: 125px; WIDTH: 223px; Z-INDEX: 103" width="35.17%">
    
    <tr>
        <td><strong><font size="4">Activities List</font></strong></td>
    </tr>
</table>
<br><!-- RDS Control --></font></h1>

<h1 align="center"><font color="#160b5a">&nbsp;</h1>
<h2>

<table border="1" datasrc="#SControl" style="LEFT: 69px; POSITION: absolute; TOP: 187px; Z-INDEX: 100">
  <tdbody>
  <tr>
	<td width="50"><input datafld="EvDate" size="15" id="text0" name="Date"></td>
	<td width="50"><input datafld="EvTime" size="15" id="text1" name="Time"></td>
	<td width="50"><input datafld="Location" size="15" id="text2" name="Location"></td>
	<td width="50"><input datafld="Description" size="15" id="text3" name="Description"></td>
  </tr></tdbody>
</table>

<script language="VBScript">

'---- enum Values ----
Const adcExecSync = 1
Const adcExecAsync = 2

'---- enum Values ----
Const adcFetchUpFront = 1
Const adcFetchBackground = 2
Const adcFetchAsync = 3

SUB Load
	'Change the asynchronous options such that execution is synchronous
	'and Fetching can occur in the background
	SControl.ExecuteOptions = adcExecSync
	SControl.FetchOptions = adcFetchBackground
	
	'Define SQL
	SControl.SQL = "Select * from Unlocking"
	
	
	' Any of these 3 connect strings would work. I like the third one because
	' the connection details are not hard-coded and are hidden.
	' The username and password are not visible with that connect string.
	 SControl.Connect = "dsn=unlocking;UID=sa;PWD=;" ' System DSN must be installed on this system
	' SControl.Connect = "DRIVER=SQL Server;SERVER=Celebris;User Id=sa;PASSWORD=;APP=Developement Environment;WSID=CELEBRIS;DATABASE=Tracking"
	'SControl.Connect = "Filedsn=\\Chip\C\Data\32XSeminars\VisualInterDev 6 Introducing\Tracking.dsn;"

	SControl.Refresh
	
END SUB

</script>
<img src="Image1.gif" style="LEFT: 21px; POSITION: absolute; TOP: 7px; Z-INDEX: 101" WIDTH="81" HEIGHT="81"></h2></font>
</body>
</html>
