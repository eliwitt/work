<HTML>
<HEAD>
<TITLE>Listing One</TITLE>
</HEAD>

<OBJECT
    ClassID="clsid:CFC399AF-D876-11D0-9C10-00C04FC99C8E"
    ID="MSXML"
    Name="xmlDoc">
</OBJECT>

<P>Enter a filename<BR>
<INPUT Name="Filename" size=40> Enter a file like http://<%=Request.ServerVariables("SERVER_NAME")%>/work/north.xml
<BR><BR>

<INPUT TYPE = "BUTTON"
    Name = "ParseButton"     
    VALUE = "Parse XML File"
    onClick = "Parse(Filename.value)">

<input type=button value="Back" onClick="history.back()">

<SCRIPT>
var BrowserWin;                  
var Page;                        

function Parse(xmlFilename)
{
    var xmlDocument;

    BrowserWin = window.open("", "XMLReport");
    Page = BrowserWin.document;

    Page.writeln("<HTML>");
    Page.writeln("<TITLE>XML Output</TITLE>");
    Page.writeln("<BODY>");
    Page.writeln("<PRE>");

//  Create a Document object and report the results.


//  Create a new object instance
    xmlDocument = MSXML;                       

//  Assign the URL from the value entered by the user
    xmlDocument.URL = xmlFilename;             
                                               
    Page.writeln("<H3>Statistics for ", xmlDoc.URL, "</H3><BR>");

//  Get the document's Root element    
    var DocumentRoot = xmlDocument.root;       

    Page.writeln("XML Version: ", xmlDocument.version);
    Page.writeln("Charcter set supported: ", xmlDocument.charset);
    Page.writeln("Document type: ", xmlDocument.doctype);
    displayTree(DocumentRoot, DocumentRoot.children.length);
    // The following are documented but not Supported:   
    //
    // Page.writeln("File Size: ", xmlDocument.fileSize);
    // Page.writeln("Date Modified: ", xmlDocument.fileModifiedDate);
    // Page.writeln("Updated: ", xmlDocument.FileUpdatedDate);
    // Page.writeln("Mime Type: ", xmlDocument.mimeType);

    Page.writeln("<input type=button value=\"Close\" onClick=\"window.close()\">");
    Page.writeln("</BODY>");
    Page.writeln("</HTML>");

// Reset xmlDocument for future use    
    xmlDocument = null;                         
}

function displayTree(docObject, N) {
    var child;
    var i, length;
    var indentStr;
    var A, Attr, AttrList;

    // Guarantee a document object exists

    if (docObject == null) {
       alert("No Document Object for this file!");
       BrowserWin = Page;              
    }

    // Indent string for displaying child nodes
    indentStr = "";
    for (i = 1; i <= N; i++)
       indentStr = indentStr + "  ";
    
    // Get the number of child elements 
    if (docObject.children != null) 
       length = docObject.children.length;
    else
       length = 0;
    
//  Display the element information, indenting child nodes.

//  Only display elements
    if (docObject.type == 0) {
       Page.writeln(indentStr, "=====");
       Page.writeln(indentStr, "Element Type: ", GetTypeStr(docObject.type));
       Page.writeln(indentStr, "Tag Name: ", docObject.tagName);

//  This only looks for "ID" attributes
       Attr = docObject.getAttribute("ID");    
       Page.writeln(indentStr, "Attribute: ", Attr);

       Page.writeln(indentStr, "Number of Children: ", length);
//  skip text for root node
       if (docObject.parent != null)           
          Page.writeln(indentStr, "Text: ", docObject.text);
       Page.writeln(indentStr, "=====<BR>");
     }

// If the element has children, call displayTree recursively
    if (docObject.children != null) {

          for (i = 0; i < docObject.children.length; i++) {
            if (N = length)
               N = N + 1;
            child = docObject.children.item(i);
            displayTree(child, N);
        }
    }
}

function GetTypeStr(type) {

  if (type == 0)
    return "ELEMENT";

  if (type == 1)
    return "TEXT";

  if (type == 2)
    return "COMMENT";

  if (type == 3)
    return "DOCUMENT";

  if (type == 4)
    return "DTD";
  else
    return "OTHER";
}

</script>
</BODY>
</HTML>
