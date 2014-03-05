<%@ LANGUAGE = PerlScript %>
<!--#include file="PrtErr.asp"-->
<html>
<head>

<% 
#!/serve/bin/perl5
#
#  This program will read each file found in the directory and 
#  produce an index file of the files in that directory.
#
#

#
# setup variable processing.
#
$Header = 0;
$DEBUG = 0;
$error = 0;
#
# Do house keeping.
#

# Are we running in debug mode
$DEBUG = ($Request->querystring('De')->item?$Request->querystring('De')->item:0);
if ($DEBUG) { 
	&PrtErr("Running in debug mode<br>");
}

# open the directory and find all of the htm files
$VDir = ($Request->querystring('VDir')->item?$Request->querystring('VDir')->item:0);
&PrtErr("You have not supplied a virual directory name<br>\n", __LINE__) if (!$VDir);

$HtmDir = ($Request->querystring('HDir')->item?$Request->querystring('HDir')->item:0);
if ($HtmDir) {
	opendir (HDir , "$HtmDir") || &PrtErr("Cann't open directory $HtmDir ", __LINE__);
} else {
	&PrtErr("$HtmDir is not a directory", __LINE__);
}

if (!$error) {
%>

<title>Index file for <%=$VDir%> </title>
</head>
<body bgcolor=white>
<h1> Index of files in the <%=$VDir%> Directory </h1>
<p>
<ol>

<%
#
# Main processing loop
#
while ($file = readdir(HDir)) {

	&PrtErr("Inside Main Loop for $file<br>\n") if $DEBUG;

	SWITCH: {

		$file =~ /^(\.|\.\.|_)/ && do { # skip this entry
			last SWITCH;
		};

		$file =~ /^\b(default)\b/ && do { # skip this entry
			last SWITCH;
		};

%>
<li><a href="../<%=$VDir%>/<%=$file%>"><%=$file%></a> Add your text here<br>
<%
	}

}
}
%>
</ol></body></html>
