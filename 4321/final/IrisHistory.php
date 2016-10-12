<?php
include("../../../includes/dbconn.inc.php"); //db connection
include("shared.php");
$conn = dbConnect();
//end connections



print $PageHeader; 
print $Navigation;
if (isset($_SESSION['id'])) {
	$CID = $_SESSION['id'];
} else {print "Log in to view order history.";}//possibly move everything below into the above if()
if (isset($CID)) {
	$sql = "SELECT * FROM IrisSale WHERE CID = '$CID' ORDER BY TID DESC";//this selects all sales transactions made by this customer
	$rs = $conn->query($sql) or die ("IrisSale link failed.");
	$number = $rs->num_rows;
	print "<p>You have ".$number." transactions saved. They are presented below starting with the most recent. Select one to view details.</p><br>";
	print "<form method='POST' action=''>";
	while($row = $rs->fetch_assoc()){
		print "<input type='radio' name='TID' value='".$row['TID']."'>
		Total: $".$row['total']." Date: ".$row['month']."/".$row['day']." at ".$row['time']."<br>";//listing info about the transactions.
	}
	print "<input type='submit' name='Select' value='Inspect Order'>";
	print "</form>";
}

if (isset($_POST['Select'])) {
	$TID = $_POST['TID'];
	$sql = "SELECT * FROM IrisSaleCalc WHERE TID = '$TID' ORDER BY PID ASC";

	$rs = $conn->query($sql) or die ("IrisSaleCalc link failed.");
	print "<table class=products>";
	while($row = $rs->fetch_assoc()){
		$PID = $row['PID'];
		$sql2 = "SELECT * FROM IrisProducts WHERE $PID = PID ORDER BY PID ASC";
		$rs2 = $conn->query($sql2) or die ("IrisProducts link failed.");
		while($row2 = $rs2->fetch_assoc()){
			print "<tr>
			<td><img src=\"./products/".$row2['img']."\" alt=\"".$row2['item']."\"</td>
			<td>".$row2['item']."</td>
			<td>Individual Price:".$row['cost']."</td>
			<td>Quantity:".$row['quant']."</td>
			<td>Item total:".$row['itemtotal']."</td>
			</tr>";
		}//inside Products that are the product on that instance of ISCalc
	}//inside ISCalc
	//because a double-DB call didn't work.
	print "</table>";
}

print $PageFooter;?>
