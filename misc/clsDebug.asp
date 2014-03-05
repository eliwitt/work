<%
Class clsDebug
	Dim mb_Enabled
	Dim md_RequestTime
	Dim md_FinishTime
	Dim mo_Storage

	Public Default Property Get Enabled()
		Enabled = mb_Enabled
	End Property
	Public Property Let Enabled(bNewValue)
		mb_Enabled = bNewValue
	End Property

	Private Sub Class_Initialize()
		md_RequestTime = Now()
	Set mo_Storage = _
		Server.CreateObject("Scripting.Dictionary")
	End Sub

	Public Sub Print(label, output)
		If Enabled Then
			'save output to internal dictionary
			Call mo_Storage.Add(label, output)
		End If
	End Sub

	Public Sub [End]()
	md_FinishTime = Now()
	If Enabled Then
		Call PrintSummaryInfo()
		Call PrintCollection _
			("VARIABLE STORAGE", mo_Storage)
		Call PrintCollection _
			("QUERYSTRING COLLECTION", _
			Request.QueryString())
		Call PrintCollection("FORM COLLECTION", _
			Request.Form())
		Call PrintCollection _
				("COOKIES COLLECTION", _
				Request.Cookies())
		Call PrintCollection _
			("SERVER VARIABLES COLLECTION", _
			Request.ServerVariables())
	End If
	End Sub

	Private Sub PrintSummaryInfo()
	With Response
		.Write("<hr>")
		.Write("<b>SUMMARY INFO</b></br>")
		.Write("Time of Request=" & _
			md_RequestTime) & "<br>"
		.Write("Elapsed Time=" & DateDiff("s", md_RequestTime, md_FinishTime) & " seconds<br>")
		.Write("Request Type=" & _
			Request.ServerVariables _
			("REQUEST_METHOD") & "<br>")
		.Write("Status Code=" & Response.Status _
			& "<br>")
	End With 
	End Sub

	Private Sub PrintCollection(Byval Name, _
		ByVal Collection)
	Dim vItem
	
	Response.Write("<br><b>" & Name & "</b><br>")
		For Each vItem In Collection
			Response.Write(vItem & "=" & _
				Collection(vItem) & "<br>")
		Next
	End Sub

	Private Sub Class_Terminate()
	Set mo_Storage = Nothing
	End Sub
End Class
%>