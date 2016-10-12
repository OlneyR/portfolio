<?php
include("../../../includes/dbconn.inc.php"); //db connection
include("shared.php");
$conn = dbConnect();
//end connections

print $PageHeader; 
print $Navigation;

if (isset($_POST['Submit'])) {
	$sql = "SELECT * FROM IrisProducts order by PID ASC";//repeat this in PROCESSING file, removing table and making input areas contain $_POST information
	$rs = $conn->query($sql) or die ("query failed");
	$totalcost = 0;
	print "<form action='IrisComplete.php' method='POST'>";
	print "<table class='products'>";
	while ($row = $rs->fetch_assoc()){
		$quan=$_POST[$row['PID']."_quan"];//do these need {}s around the interior?
		$cost=$_POST[$row['PID']."_cost"];
		print "<input name='".$row['PID']."_quan' type='hidden' value='".$quan."'>
			<input name='".$row['PID']."_cost' type='hidden' value='".$cost."'>";
		if ($quan >= 1) {
			$totalcost += ($cost*$quan);
			$linecost = ($cost*$quan);
			print "<tr><td><img src=\"./products/".$row['img']."\" alt=\"".$row['item']."\"</td>
				<td>".$row['item']."</td>
				<td>Amount Ordered: ".$quan."</td>
				<td>After discount price: ".$cost."</td>
				<td>Item total: ".$linecost."</td></tr>";
		}
	}//I know I could have just done HTML and used PHP only for variables.
	print "
		<input name='Fname' type='hidden' value='".$_POST['Fname']."'>
		<input name='Lname' type='hidden' value='".$_POST['Lname']."'>
		<input name='email' type='hidden' value='".$_POST['email']."'>
		<input name='totalcost' type='hidden' value='".$totalcost."'>
		<input name='monthset' type='hidden' value='".$_POST['monthset']."'>
		<input name='dayset' type='hidden' value='".$_POST['dayset']."'>
		<input name='timeset' type='hidden' value='".$_POST['timeset']."'>";
	print "<tr><td> Total Cost: ".$totalcost."</td>
	<td colspan = 2> Date and time chosen: ".$_POST['monthset']."/".$_POST['dayset']." at ".$_POST['timeset']."</td>
	<td><input type='submit' name='Submit2' value='Submit Order'></td></tr>";
	print "</table></form>";
}//<input name="1_price" type="hidden" value=".."> 
//type="hidden"will be used much here
?>

<?php print $PageFooter;?>
