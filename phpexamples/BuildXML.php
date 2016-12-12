<?php
include('./MOInfo.php');
include('./function.php');
$theRoot = "c:\\steve\\test\\";
$debug = 0;
$message = "";
$theprdattrs = "";
session_start();
$theInfo = $_SESSION['theDetail'];

switch (@$_POST['BtnAct'])
{
	case "Start Over":
		$_SESSION['theResult'] = "Start over, enter your next mo or so #.";
		header("Location: MOHandler.php");
		break;
	case "Place the Job":
		//  check that the art folder is there and has something in it.
		//  create the xml
		$theDir = $theRoot . $theInfo->so . "\\" . $theInfo->mo . "\\art";
		if (!is_dir($theDir))
			$message = "Directory " . $theDir . " does not exists, please create and resubmit your request.";
		// now read all of the files in the directory and look for image files
		if ($message == "") {
			$dirlst = opendir($theDir);
			$foundart = 0;
			while($filename = readdir($dirlst)) {
				$filepath = $theDir . $filename;
				$file_parts = pathinfo($filepath);
				//echo "[" . $file_parts['extension'] . "]<br/>";
				if (preg_match('/(jpeg|jpg|png|gif)$/i', $file_parts['extension']))
					$foundart = 1;
			}
			if ($foundart == 0)
				$message = "No art files were found in " . $theDir;
		}
		if ($message == ""){
			$theattrs = array();
			$theprdattrs = "<pre>";
			$message = "<p>Here are the attrs<br />";
			connect();
			get_the_mo_attr( $theattrs, $theInfo->mo );
			close_it();
			foreach($theattrs as $key => $value)
			{
				if (preg_match('/^(TRI|SSP|BU|WBU|EXT|TR|FL|FLT|JR|SSP|WTR|POS)/i', $key)){
					switch ($key) {
						case ($key == "JR10" or $key =="SSP10") :
							$theprdattrs .= "Product " . $value . " Product ";
							break;
						default:
							$theprdattrs .= "<unkonwn>" . $key . " and " . $value . "</unknown>";
							break;
					}
				} else {
					$theprdattrs .= " attr " . $key . " has not been implemented at this time.<br/>";
				}
			}
			$message .= $theprdattrs . "</pre>";
		}
		//  
		// if message is blank then we can create the xml file in its folder
		//
		if ($message == "") {
			$theDir = $theRoot . $theInfo->so . "\\" . $theInfo->mo . "\\xml";
			if (!is_dir($theDir)) {
				mkdir($theDir);
			}
			$fh_out = fopen($theDir . "\\" . $theInfo->mo . ".xml","w");
			fwrite($fh_out,$theInfo->toXML());
			fclose($fh_out);
		}

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
    		</p>
    		<input type="submit" name="BtnAct" value="Start Over"><br />
    		<input type="submit" name="BtnAct" value="Place the Job">
		</form>
		<p>Please review the information and if correct then place the job.</p>
</body> 
</html>