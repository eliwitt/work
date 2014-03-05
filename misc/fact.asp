<%@ LANGUAGE=VBScript %>
<HTML>
<HEAD>
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
</HEAD>
<BODY>

<% 

If (Request.ServerVariables("Content_Length")>0) Then
	Set SSObj = Server.CreateObject("Factorial.Scriptlet")
	rval = SSObj.Calculate(Request("uval"))
%>

Here is your results <%=rval%>

<%

Else

%>
<FORM method=post action="<%=Request.ServerVariables("SCRIPT_NAME")%>">
Please enter a number so that it can be factored <input type=text name="uval">
<input type=submit name="Submit" value="Submit">
</FORM>
<%

End If

%>
<p />
<input type=button value="Back" onClick="history.back()">
</BODY>
</HTML>
