<?php
session_start();
if(isset($_SESSION['id'])){
 $Linout = "<p>Welcome ".$_SESSION['Fname']." ".$_SESSION['Lname'].",</p><a href='IrisLogout.php'>Log Out</a>";
}
else {$Linout = "<a href='IrisLogin.php'>Log In</a> ";}
if (isset($_SESSION['history'])){
	if ($_SESSION['history']==1){
		$Linout .= "<br><a href='IrisHistory.php'>History</a>";
	}
}

$PageHeader = "
<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<title>Iris Coffee and Bagel</title>
	<link rel='stylesheet' href='style.css' type='text/css'>
</head>
<body>
	<div id='wrapper'>
		<header>
			<h1 id='headerInfo'>
				817-561-9989<br>
				Open: 5:30am - 2pm<br>
				Sundays: 7am - 2pm
			</h1>
			<div id='account'>
				".$Linout."
			</div>
		</header>
";


$Navigation = "
		<div id='navbreak'></div>

		<div id='nav'>
			<ul>
				<li><a href='Iris.php'>Home</a><br></li>
				<li><a href='IrisMap.php'>Find Us</a><br></li>
				<li><a href='IrisOrder.php'>Order pickup</a></li>
			</ul>
			<hr color=black width='75%'>
		</div>
		<div id='body'>
";


$PageFooter = "
		</div>
		<div id='footer'>
			Coffee Shop Arlington, TX - Iris Bagel and Coffee House<br>
			Site made for CTEC 4321 Project by Richard Olney			
		</div>
	</div>
</body>
</html>
";

function nukeMagicQuotes() {
  if (get_magic_quotes_gpc()) {
    function stripslashes_deep($value) {
      $value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
      return $value;
    }
    $_POST = array_map('stripslashes_deep', $_POST);
    $_GET = array_map('stripslashes_deep', $_GET);
    $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
  }
}


function quote_smart($value) 
{ 
	global $conn; // make the database connection avalible inside this function
   
    // check to see if $value is an array
	if (is_array($value)){
		// $value is an array, prepare a function to be used for array_map
		function quote_smart_array($v){
			$v = $conn-> real_escape_string($v);
			return $v;
		}
		// apply quote_smart_array to each of the elements in $value
		$value = array_map('quote_smart_array', $value);
	}
     else {
		// $value is not an array, apply real_escape_string directly
        $value = $conn->real_escape_string($value) ; 
    } 

	
    return $value; 
} 
?>
