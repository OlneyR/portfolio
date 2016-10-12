<?php
// acquire shared info from other files
include("../../../includes/dbconn.inc.php"); // database connection 
include("shared.php"); // stored shared contents, such as HTML header and page title, page footer, etc. in variables

// make database connection
$conn = dbConnect();

print $HTMLHeader; 
print $PageTitle;

$lid = ""; // place holder for product id information


//See if a product id is available from the client side. If yes, then retrieve the info from the database based on the product id.  If not, present the form.
if (isset($_GET['lid'])) { // note that the spelling 'pid' is based on the query string variable name

	// product id available, validate the information, then compose a query accordingly to retrieve information.

	$lid = $_GET['lid']; 

	// validate the product id -- check to see if it is a number
		if (is_numeric($lid)){
			//compose a select query
			$sql = "DELETE from links WHERE linkID = $lid"; // note that the spelling "PID" is based on the field name in the database product table.
			$rs = $conn->query($sql) or die ("delete query failed");

			if ($rs) {
				$output = "<p>The selected record has been seccessfully deleted.</p>";
			} else {
				$output = "<p>The database operation to delete the record has been failed.  Please try again or contact the system administrator.</p>";
			}
			
		} else {
		// product id is not a number. reset $pid
		$lid = "";
		// compose an error message
		$output = "<p><b>!</b> If you are expecting to delete an exiting item, there are some error occured in the process.  Please contact the webmaster.  Thank you.</p>";
		}
} else {
	// $_GET['pid'] is not set, which means that no product id is provided
	$output = "<p><b>!</b> To manage product records, please follow the link below to visit the admin page.  Thank you. </p>";
}

?>
<br>
<?= $SubTitle_Admin ?>
<?= $output ?>

<p>Back to the <a href='link_list_admin.php'>link list page</a></p>


<?php print $PageFooter; ?>

</body>
</html>