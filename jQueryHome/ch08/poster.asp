<%@ Language=VBScript %>
<% option explicit %>
<%

if Request.Item("data") = 1 then
	response.write "You sent the server a value of 1."
else
	if Request.Item("data") = 2 then
		response.write "You sent the server a value of 2."
	else
		response.write "Error."
	end if
end if
%>