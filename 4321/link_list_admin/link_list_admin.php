<?php
// acquire shared info from other files
include("../../../includes/dbconn.inc.php"); // database connection 
include("shared.php"); // stored shared contents, such as HTML header and page title, page footer, etc. in variables

// make database connection
$conn = dbConnect();

	print $HTMLHeader; 
	print $PageTitle;

?>
<script>
function confirmDel(title, lid) {
	url = "delete.php?lid="+lid;
	var agree=confirm("Delete this item: <" + title + "> ? ");
	if (agree) {
		location.href = url;
	}
	else {
		return;
	}
}
</script>

<?php
	$sql = "SELECT * FROM links, LinkCategory where links.kcategoryID = LinkCategory.CID order by LinkCategory.Name";
	$rs = $conn->query($sql) or die ("query failed");

	$thisCategoryID = ""; // placeholder for the category ID of the current row
	while ($row = $rs->fetch_assoc()) {
		
		//prepare the title for the javascript function call
		$title_js = str_replace("'","",$row['siteName']);

		$tblRows = $tblRows."<tr><td>{$row['siteName']}</td>
								 <td>{$row['Name']}</td>
							     <td><a href='form.php?cid={$row['linkID']}'>Edit</a> | <a href='javascript:confirmDel(\"$title_js\",{$row['linkID']})'>Delete</a> </td></tr>";
	
	}
	

	// Free result set and close connection
	$rs -> free_result();
	$conn->close();
?>
	
		
<?= $SubTitle_Admin ?>
<br>
| <a href="form.php">Add a new item</a> |<br>
<table border=1 cellpadding=4>
<tr><th>siteName</th><th>Category</th><th>Options</th></tr>
<?= $tblRows ?>
</table>

<?php print $PageFooter; ?>

</body>
</html>