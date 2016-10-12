<?php
// store shared information in this file, such as headers, menu, and footers

//HTML Header
$HTMLHeader = "
<html>
<head>
	<title>Link Admin System</title>
	<link rel=stylesheet href=style.css type=text/css>
</head>
<body>
";

//Page Header
$PageTitle = "<b>Link Admin System</b><hr size=1 noshade>";


$SubTitle_Admin = "<h3>Database interface</h3>";

//Page Footer
$PageFooter = "
	<table width=600>
	<tr><td>
		<center>
		<hr size=1 noshade>
		<a href='/~rco2253/4321'>Back to course folder</a>

		</center>
	</td></tr>
	</table>
";

function nukeMagicQuotes() {
  // check to see if magic quotes setting is on
  if (get_magic_quotes_gpc()) {
	// if yes, prepare a function to deal with the $_POST, $_GET, and $_COOKIE arrays.  See below.
    function stripslashes_deep($value) {
		if (is_array($value)) {	
			//$value is an array, apply stripslashes_deep to each of the array elements
			$value = array_map('stripslashes_deep', $value);
		} else {
			//$value is not an array, apply stripslashes
	 	   $value = stripslashes($value);
		}
      return $value;
      }

	// nukeMagicQuotes() is a general purpose function.  Therefore, $_POST, $_GET, and $_COOKIE arrays are all dealt with here, even though you may only use one of them.
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