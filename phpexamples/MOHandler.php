<?php
$debug = 0;
$message = "Enter either the MO or the SO for the Job";
include('./function.php');
include('./MOInfo.php');

$moStuff = new MOInfo;
session_start();
$message = $_SESSION['theResult'];
unset($_SESSION['theResult']);
switch (@$_POST['Button'])
{
	case "Lookup":
		if ($_POST['mono'] != "") {
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
		} elseif ($_POST['sonu'] != "") {
			$message = "<b>SO Not implemented</b>";
		} else {
			$message = "Enter either the MO or the SO for the Job";
		}
		break;
}
?>
<html> 
<head>
<title>Art Mo Handler</title>
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
            Get the <input type="submit" name="Button" value="Lookup">
		</form>
<p>
<?php echo $message; ?>
</p>
</body> 
</html>