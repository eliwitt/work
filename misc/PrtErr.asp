<%
#
# This is a general print routine for trace diagnostics
#
sub PrtErr {

my ($msg, $end) = @_;

%> <%=$msg%> <br><%

if($end) {
	%>
</body></html>
<%
	$error = 1;
}

}

%>
