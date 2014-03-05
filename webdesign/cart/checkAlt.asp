<%@ Language=VBScript %>
<% option explicit %>
<%
	response.write "Welcome to the check out.<p />"
	Call PrintCollection (Request.Form())
    response.write "<p />Thank you for shopping with us."

	Private Sub PrintCollection(ByVal Collection)
	    Dim i
		for i = 1 to Collection("productId[]").count
		    Response.Write("ProductID: " & Collection("productId[]")(i) & ", Qty:" & Collection("productQty[]")(i) & "<br>")
		next
	End Sub

%>