<?php
//------------------------------------------
// modified from PHP Solutions files
//------------------------------------------

// each page needs a different name for the submit button
if (array_key_exists('Submit1', $_POST)) {
  session_start();
  include ("shared.php");
  nukeMagicQuotes();
  // clear any existing session variables.
  $_SESSION = array();
  // set a variable to control access to other pages
  $_SESSION['formStarted'] = true;
  // set required fields
  // must be an array, even if only one item is required
  // if no fields are required, an empty array is needed
  // otherwise, in_array() later in the script will generate an error
  $required = array('name');
  // create empty array for any missing fields.  
  $_SESSION['missing'] = array();
  
  // process the $_POST variables and save them in the $_SESSION array
  foreach ($_POST as $key => $value) {
    // assign to temporary variable and strip whitespace if not an array
    $temp = is_array($value) ? $value : trim($value);
	// if empty and required, add to $missing array
	if (empty($temp) && in_array($key, $required)) {
	  array_push($_SESSION['missing'], $key);
	  }
	// otherwise, assign to a variable of the same name as $key
	else {
	  $_SESSION[$key] = $temp;
	  }
	}
  // if no required fields are missing, redirect to next page
  //if (!$missing) {
    header('Location: multiple02.php');
	exit;
	//}
  }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Multiple form 1</title>
</head>

<body>

<form id="form1" name="form1" method="post" action="">
    <p>
		All fields required.<br>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" />
    </p>
    <p>
        <input type="submit" name="Submit1" value="Next &gt;" />
    </p>
</form>
</body>
</html>

