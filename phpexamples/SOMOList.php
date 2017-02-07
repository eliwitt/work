<?php
include('./MOInfo.php');
include('./functionMOHandler.php');
$debug = 0;
$firstEntry = 1;
$message = "";
session_start();

switch (@$_POST['BtnAct'])
{
	case "Start Over":
		$_SESSION['theResult'] = "Start over, enter your next mo or so #.";
		header("Location: MOHandler.php");
		break;
	case "Place the Job":
		//
		//  Loop thru the MOs and verify that the art is in place.
		//
		$theMOs = $_SESSION['theMOS'];
		if ($debug == 1) {
			print_r($_POST['jobMOs']);
		}
		$message = "";
		$jobMOs = $_POST['jobMOs'];
		foreach ($jobMOs as $mo) {
		
			foreach ($theMOs as $theMO) {
				if ($theMO->mo == $mo) {
					$first = 1;
					$hit = 0;
					$theMOResult = processMO($theMO);
					if ($theMOResult != "")
						$message .= $theMO->mo . " had this error " . $theMOResult . "<br />";
				}

			}

		}
		if ($message == "") {
			$_SESSION['theResult'] = "Job Placed, enter your next mo or so #.";
			header("Location: MOHandler.php");			
		} 
		break;
	default:
		$theMOs = $_SESSION['theMOS'];
		$message = "Don't forget that you need to have the folder and art work ready for each MO.";
}
?>
<html> 
<head>
<title>Art SO Mo Handler</title>
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
    font-size: 12px;
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
		<h2>Job Verification for the Sales Order</h2>
		</header>

		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<p>
<?php
	if ($debug == 1)
		print_r($theMOs);

	foreach ($theMOs as $theMO) {
		if ($theMO->mo != "") {
			if ($firstEntry == 1)
			{
				$firstEntry = 0;
				echo "<h2>" . $theMO->so . "</h2>";
			}
			echo "<br /><input type='checkbox' name='jobMOs[]' value='" . $theMO->mo . "' />"
				. $theMO->toString() . "<br />";
		}
	}
?>
    		</p><br /><br />
    		<input type="submit" name="BtnAct" value="Start Over">&nbsp;
    		<input type="submit" name="BtnAct" value="Place the Job">
		</form>
		<p>Please review the information and select those MOs you want to use for the job.</p>
<?php
//
// display info for worker to review and proceed
//
echo "<br />" . $message;
?>		
	</section>
	<img src="images\vpi_window.jpg" />
</body> 
</html>