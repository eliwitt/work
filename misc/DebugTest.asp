<%@ Language=VBScript %>

<% option explicit %>

<!--#Include File="clsDebug.asp"-->

<%
Dim Debug

Set Debug = New clsDebug
Debug.Enabled = True

Dim x

x = 10
Debug.Print "x before math", x
x = x + 50
Debug.Print "x after math", x

Response.Cookies("TestCookie") = "Hello VBPJ"
%>

<form name="form1" method="post" action="DebugTest.asp">
	<input type="text" name="text1">
	<input type="submit" name="submit1" value="Info Post">
</form>
<p />
<form method="get" name="form2" action="DebugTest.asp">
	<input type="text" name="text2">
	<input type="submit" name="submit2" value="Info Get">
</form>
<p />
<input type=button value="Back" onClick="history.back()">

<%
Debug.End
Set Debug = Nothing
%>