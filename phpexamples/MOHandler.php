<?php
$debug = 0;
include('./MOInfo.php');
include('./functionDB.php');

$message = "";
$moStuff = new MOInfo;
session_start();
$message = $_SESSION['theResult'];
unset($_SESSION['theResult']);
switch (@$_POST['Button'])
{
	case "Lookup":
		if ($_POST['mono'] != "" && $_POST['sonu'] == "") {
			connect();
			$moStuff->mo = $_POST['mono'];
			get_the_mo_info($moStuff);
			//
			if ($debug == 1)
				echo "the mo " . $moStuff->mo . " " . $moStuff->cuno . "<br />";
			//
			close_it();
			//
			// build the page for the xml creation here
			//
			$_SESSION['theDetail'] = $moStuff;
			header("Location: BuildXML.php");
		} elseif ($_POST['mono'] == "" && $_POST['sonu'] != "") {
			connect();
			$theMOs = get_the_so_info( $_POST['sonu'] );
			if ($debug == 1)
				print_r($theMOs);
			close_it();
			//
			// build the page for the so list of mos
			//
			$_SESSION['theMOS'] = $theMOs;
			header("Location: SOMOList.php");
		} else {
			$message = "Enter either the MO or the SO for the Job, not both.";
		}
		break;
	default:
		if ($message == "")
			$message = "Enter either the MO or the SO for the Job";
}
?>
<html> 
<head>
<title>Art Mo Handler</title>
<style type="text/css">
body {
	
	background-image: url(images/VPI_OldSign.jpg);
	margin: 0; 
	padding: 30px 24px 24px; 
	width: 100%; height: 100%;
	background-attachment:fixed;
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	background-repeat: no-repeat;
	background-position: center center;
	background-attachment: fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}
/* the container area */
.container{
    width: 40%;
    margin: 5px auto;
    font-size: 10px;
	background: #ddd;
	padding: 10px;
	border-top-left-radius: 6px;
	border-top-right-radius: 6px;
	border-bottom-left-radius: 6px;
	border-bottom-right-radius: 6px;
}
</style>
</head>
<body> 
	<section class="container">
		<header>
		<h2>Job Lookup</h2>
		</header>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<p>
			MO #: <input type="text" pattern="[0-9]{6}" name="mono" id="mono" size="6" autofocus title="MO is a 6 digit field" />
			<br />Or<br />
			SO #:<input type="text" name="sonu" id="sonu" size="8" title="Sales Order is 8 digits" />
    		</p>
            <input type="submit" name="Button" value="Lookup"> the data for the MO or the SO.
		</form>
	<p><?php echo $message; ?></p>
	</section>
</body> 
</html>