<?php
// acquire shared info from other files
include("../../../includes/dbconn.inc.php"); // database connection 
include("shared.php"); // stored shared contents, such as HTML header and page title, page footer, etc. in variables

// make database connection
$conn = dbConnect();

print $HTMLHeader; 
print $PageTitle;

// Process only if there is any submission
if (isset($_POST['Submit'])) {


	//check magic_quote setting and strip added slashes if necessary
	nukeMagicQuotes();

	// ==========================
	//validate user input
	
	// set up the required array 
	$required = array("siteName", "siteURL", "kcategoryID"); // note that, in this array, the spelling of each item should match the form field names

	// set up the expected array
	$expected = array("lid", "siteName", "siteURL", "kcategoryID"); // again, the spelling of each item should match the form field names

	$missing = array();
	
	foreach ($expected as $field){
		// isset($_POST[$field]):  Note that if there is no user selection for radio buttons, checkboxes, selection list, then $_POST[$field] will not be set

		// Under what conditions the script needs to record a field as missing -- $field is required and one of the following two (1)  $_POST[$field] is not set or (2) $_POST[$field] is empty

		//echo "$field: in_array(): ".in_array($field, $required)." empty(_POST[$field]): ".empty($_POST[$field])."<br>";

		if (in_array($field, $required) && (!isset($_POST[$field]) || empty($_POST[$field]))) {
			array_push ($missing, $field);
		
		} else {
			// Passed the required field test, set up a variable to carry the user input.  
			// Note the variable set up here uses a variable name as the $field value.  In this example, the first $field in the foreach loop is "title" and a $title variable will be set up with the value of "" or $_POST["title"]
			if (!isset($_POST[$field])) {
				//$_POST[$field] is not set, set the value as ""
				${$field} = "";
			} else {
				
				${$field} = quote_smart($_POST[$field]);
				
			}
		
		}

	}

		//print_r ($missing); // for debugging purpose

		// add more data validation here
		// ex. $price should be a number

		// proceed only if there is no required fields missing and all other data validation rules are satisfied
		if (empty($missing)){

			// compose a query: Insert or Update?
			// Note: user input could be an array, the code to deal with array values should be added before composing the queries.
			if (isset($_POST['lid']) && $_POST['lid'] != "") {
				// an existing pid ==> update query
				$sql = "Update links SET siteName = '$siteName', siteURL = '$siteURL', kcategoryID = $kcategoryID WHERE linkID = $lid";
			} else {
				// noe existing pid ==> insert query
				$sql = "Insert Into links (siteName, siteURL, kcategoryID) values ('$siteName', '$siteURL', $kcategoryID)";
			}
			 //echo "<p>$sql</p>"; // for debugging.  When a query does not work, the best way to debug is to print it out and examine the query.
			// send the query to the database
			$rs = $conn->query($sql) or die ("insert/update query failed");
			if ($rs) {
				$output = "<p>The following information has been saved in the database:<br><br>";
				/*foreach($_POST as $key=>$value){
					$output .= "<b>$key</b>: $value <br>"; //$key (form field names) may not be very indicative (ex. lname for the last name field), you can set up the form field names in a way that can be easily processed to produce more understandable message. (ex. use field names like "Last_Name", then before printing the field name, replace the underscore with a space.  See php solution 4.4)
				}*/
				foreach($required as $something) {
					$output .=  "<b>$something</b>: ${$something}<br>";
				}
				$output .= "<p>Back to the <a href='link_list_admin.php'>link list page</a></p>";
			} else {
				$output = "<p>Database operation failed.  Please contact the webmaster.";
			}
		} else {
			$output = "<p>The following required fields are missing in your form submission.  Please check your form again and fill them out.  <br>Thank you.<br>\n<ul>";
			foreach($missing as $m){
				$output .= "<li>$m</li>";
			}
			$output .= "</ul>";
		}

} else {
	$output = "Please work from the <a href='link_list_admin.php'>admin page</a>.";
}


?>
<?= $SubTitle_Admin ?>
<?= $output ?>

<?php print $PageFooter; ?>

</body>
</html>