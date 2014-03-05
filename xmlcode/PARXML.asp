<html>
<head>
<title>Parsing XML</title>
</head>

<object 
	ClassID="clsid:CFC399AF-D876-11D0-9C10-00C04FC99C8E"
	ID="MSXML"
	Name="xmlDoc">
</object>

<body>
<p>Enter a filename<br>
<input name="Filename" size=40 value="http://<%=Request.ServerVariables("SERVER_NAME")%>/work/north.xml"> just press the ParseButton.
<br><br>
<input type= "button"
	name="ParseButton"
	value="Parse XML file"
	onClick="Parse(Filename.value)">

<input type=button value="Back" onClick="history.back()">

<script>
var Browserwin;
var Page;

function Parse(xmlFilename) {

	var xmlDocument;

	Browserwin = window.open("", "XMLReport");
	Page = Browserwin.document;

	Page.writeln("<html>");
	Page.writeln("<title>XML Output</title>");
	Page.writeln("<body>");
	Page.writeln("<pre>");

	//   Create a document object and report the results 

	// create a new instance
	xmlDocument = MSXML;

	// assign the url from the value entered by the user 
	xmlDocument.URL = xmlFilename;

//	Page.writeln("<h3>Statics for ", xmlDocument.URL, "</h3><br>");
//    Page.writeln("Character set supported: ", xmlDocument.Charset, "<br>");
//    Page.writeln("Document type: ", xmlDocument.doctype, "<br>");

	// get the document's root element
	var DocumentRoot = xmlDocument.root;
	var length = DocumentRoot.children.length;
//	var article = null;
//	var kid = article.children;

//   This one works butt-head
//	Page.writeln("XML: ", xmlDocument.root.children.item("Magazine").text, "<br>");
//	Page.writeln("XML: ", xmlDocument.root.children.length, "<br>");
//		Page.writeln("<b>Tag</b>: ", DocumentRoot.children.item(nIndex).tagName, "<br><br>");

	for( nIndex = 0; nIndex < length; nIndex++) {


		var article = DocumentRoot.children.item(nIndex);
		Page.writeln("<b>Magazine</b> ", article.children.item("Magazine").text, "<br><br>");
		Page.writeln("<b>Issue Date</b> ", article.children.item("IssueDate").text, "<br><br>");
		Page.writeln("<b>Headline</b> ", article.children.item("Headline").text, "<br><br>");
		Page.writeln("<b>Deck</b> ", article.children.item("Deck").text, "<br><br>");
		Page.writeln("<b>Byline</b> ", article.children.item("Byline").text, "<br><br>");
		Page.writeln("<font color=red>How many are there:</font> ", article.children.item("ArticleText").children.length, "<br><br>");
		Page.writeln(article.children.item("ArticleText").text, "<br><br>");
		Page.writeln("<font color=green>Bio</font> ", article.children.item("BIOGRAPHY").text, "<br><br>");
		Page.writeln("<hr>");

	}

	Page.writeln("</pre>");
	Page.writeln("<input type=button value=\"Close\" onClick=\"window.close()\">");
	Page.writeln("</body>");
	Page.writeln("</html>");
	xmlDocument = null;

}


// self.document.all.Filename.focus();
</script>
</body>
</html>
