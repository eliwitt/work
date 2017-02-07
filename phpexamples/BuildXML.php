<?php
include('./MOInfo.php');
include('./functionMOHandler.php');
$debug = 0;
$message = "";
session_start();
$theInfo = $_SESSION['theDetail'];

switch (@$_POST['BtnAct'])
{
	case "Start Over":
		$_SESSION['theResult'] = "Start over, enter your next mo or so #.";
		header("Location: MOHandler.php");
		break;
	case "Place the Job":
		$first = 1;
		$hit = 0;
		$theMOResult = processMO($theInfo);
		if ($theMOResult != "")
			$message .= $theMO->mo . " had this error " . $theMOResult . "<br />";
		if ($message == "") {
			$_SESSION['theResult'] = "Job Placed, enter your next mo or so #.";
			header("Location: MOHandler.php");
		}
		break;
}

?>
<html> 
<head>
<title>Art Mo Handler</title>
<style type="text/css">
/* CSS reset */
body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,
	form,fieldset,input,textarea,p,blockquote,th,td { 
	margin:0;
	padding:0;
}
html,body {
	margin:0;
	padding:0;
}
body {
	background-color: #b1aaaa;
}
/* the container area */
.container{
    width: 50%;
    margin-left: 10px;
    font-size: 18px;
	background: #ddd;
	padding: 10px;
	float:left;
	border-top-left-radius: 6px;
	border-top-right-radius: 6px;
	border-bottom-left-radius: 6px;
	border-bottom-right-radius: 6px;
}
img {
	float:left;
	margin-left: 5px;
	width:25%;
	height:60%;
}
</style>
</head>
<body> 
	<section class="container">
		<header>
		<h2>Job Verification</h2>
		</header>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<p>
<?php
//
// display info for worker to review and proceed
//
echo $theInfo->toString();
echo "<br />" . $message;
?>
    		</p><br /><br />
    		<input type="submit" name="BtnAct" value="Start Over">&nbsp;
    		<input type="submit" name="BtnAct" value="Place the Job">
		</form>
		<p>Please review the information and if correct then place the job.</p>
	</section>
	<img src="images\vpi_window.jpg" />
</body> 
</html>