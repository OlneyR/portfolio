<?php
// acquire shared info from other files
include("../../../includes/dbconn.inc.php"); // database connection 
include("shared.php"); // stored shared contents, such as HTML header and page title, page footer, etc. in variables

// make database connection
$conn = dbConnect();


print $HTMLHeader; 
print $PageTitle;

//This form is used for both adding or updating a record.
//See if a product id is available from the client side. If yes, then retrieve the product info from the database based on the product id.  If not, present an empty form.

$lid = ""; // place holder for product id information

if (isset($_GET['linkID'])) { // note that the spelling 'pid' is based on the query string variable name.  When linking to this form (form.php), if a query string is attached, ex. form.php?pid=3 , then that information will be detected here and used below.

	// product id available, validate the information, then compose a query accordingly to retrieve information.

	$lid = $_GET['linkID']; 

	// validate the product id -- check to see if it is a number
		if (is_numeric($lid)){
			//compose a select query
			$sql = "SELECT * from links WHERE linkID = $lid"; // note that the spelling "PID" is based on the field name in my product table (database).
			$rs = $conn->query($sql) or die ("select query failed");

			// proceed only if a match is found -- there should be only one row returned in the result********************************************************************************************************************************************************************
			if ($rs->num_rows == 1){
				$row = $rs->fetch_assoc(); //since there is only one row being returned, no while loop is necessary
				
				//set up the values to be insert into the form fields
				$siteName = $row['siteName'];
				$siteURL = $row['siteURL'];
				$kcategoryID = $row['kcategoryID'];


			} else {
				$errMsg = "<b>!</b> Information on the record you requested is not available.  If it is an error, please contact the webmaster. Thank you.";
				$lid = ""; // reset $pid
			}
		} else {
		// reset $pid
		$lid = "";
		// compose an error message
		$errMsg = "<b>!</b> If you are expecting to edit an exiting item, there are some error occured in the process.  Please follow the link below to the product adminstration interface or contact the webmaster.  Thank you.";
		}
} else {
// $_GET['pid'] is not set -- no query string for pid is available.  It means that this form is requested not for editing, but for adding a new record.  No preset value needed.  Set all related variables to "".
	$siteName = "";
	$siteURL = "";
	$kcategoryID = "";
	$lid = "";
}

function CategoryOptionList($CID){
	global $conn;
	// retrieve category info from the database to compose a drop down list
	$sql = "SELECT * FROM LinkCategory order by CID";
	$rs = $conn->query($sql) or die ("category query failed");

	$list = ""; //placeholder for the CD category option list
	while ($row = $rs->fetch_assoc()) {
		// check if the category id of the current row matches the parameter ($CID) provided by the function call
		if ($row['CID'] == $CID){
			$selected = "Selected";
		} else {
			$selected = "";
		}
		//make each category an option
		$list = $list."<option value='{$row['CID']}' $selected>{$row['Name']}</option>";
	}
	
	return $list;
}
?>
<?= $SubTitle_Admin ?>
<br>
<b>Link information form</b><br>

<?= $errMsg ?>
<br>
<form action="edit.php" method="POST">

	<!-- pass the pid information using a hidden field -->
	<input type="hidden" name="lid" value=<?=$lid?>>

	<table>
		<tr><td>Site Name:</td><td><input type="text" name="siteName" size="45" value="<?= $siteName ?>"></td></tr>
		<tr><td>Site URL:</td><td><input type="text" name="siteURL" size="45" value="<?= $siteURL ?>"></td></tr>
		<tr><td>Category:</td><td><select name="kcategoryID"><?= CategoryOptionList($kcategoryID)?></select></td></tr>
		<tr><td colspan=2><input type=submit name="Submit" value="Submit Link Information"></td></tr>
	</table>

</form>

<?php print $PageFooter; ?>

</body>
</html>