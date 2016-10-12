<?php
include("../../../includes/dbconn.inc.php"); //db connection
include("shared.php");
$conn = dbConnect();
//end connections
if (isset($_SESSION['id'])) {
	$CID = $_SESSION['id'];//CID get in cases of account
} else {
	//acquire name, last, email and set pass to 'temp'
	//set this into account and take the new CID
	if (isset($_POST['Submit2'])) {
		nukeMagicQuotes();
		$required = array("email");
		$expected = array("email","Fname","Lname");
		$missing = array();
		$pass = "temp";
		foreach ($expected as $field){
			if (in_array($field, $required) && (!isset($_POST[$field]) || empty($_POST[$field]))) {
				array_push ($missing, $field);
			} else {
				if (!isset($_POST[$field])) {
					${$field} = "Nope";
				} else {
					${$field} = quote_smart($_POST[$field]);
				}
			}
		}
		if (empty($missing)){//potentially make sql check for already-present account w/ that email
			if (isset($email) && ($email != "")) {
				$sql ="SELECT * FROM IrisAccount WHERE email = '$email'";
				$rs = $conn->query($sql) or die ("previous acct check failure");
				$number = $rs->num_rows;
				if ($number == 0) {
					$sql = "Insert Into IrisAccount (email, pass, Fname, Lname) values ('$email','$pass','$Fname','$Lname')";
					$rs = $conn->query($sql) or die ("Account's first insert/update query failed");
					$sql = "SELECT * FROM IrisAccount WHERE email = '$email'";
					$rs = $conn->query($sql) or die ("Account's CID grab query failed");
					while($row = $rs->fetch_assoc()){
						$CID = $row['CID'];//CID get in cases of no account, after post submission
					}//while won't run if an account already exists
				}
				if (!isset($CID)) {//then you aren't logged in, and the email you gave already exists
					print "The email you listed here already has an account. Either log in or use another email address.<a href='IrisOrder.php'>Go back.</a>";
				}
			}
		}//end if empty
	}//end if isset
}//end else (@this point $CID is set for both set and temp accts)

//by this point $CID is set, temp accounts are stored

if (isset($CID) && isset($_POST['monthset']) && isset($_POST['dayset']) && isset($_POST['timeset'])) {
	nukeMagicQuotes();
	$mth= $_POST['monthset'];
	$date= $_POST['dayset'];
	$tme= $_POST['timeset'];
	$totalcost= round( $_POST['totalcost'], 2);
	if ($totalcost > 0) {//then more than 0 are chosen
		$sql = "Insert Into IrisSale (CID, total, month, day, time) values ('$CID','$totalcost','$mth','$date','$tme')";
		$rs = $conn->query($sql) or die ("Sales' insert/update query failed");
		/*$TID = mysql_insert_id();*/
	}
	//sadly mysql_insert_id didn't work. i'll be getting the TID the long way
	$sql = "SELECT * FROM IrisSale WHERE CID = '$CID' ORDER BY TID ASC";
	$rs = $conn->query($sql) or die ("Sales' insert/update query failed");
	while ($row = $rs->fetch_assoc()) {
		$TID = $row['TID'];//TID ASC will make this run over itself until the most recent (highest number) TID. Then exit with accurate $TID.
	}
//by this point $TID is created, transaction has begun

	if (isset($TID)){
		$sql = "SELECT * FROM IrisProducts order by PID ASC";
		$rs = $conn->query($sql) or die ("query failed");
		while ($row = $rs->fetch_assoc()) {
			$quan=$_POST[$row['PID']."_quan"];
			$cost=$_POST[$row['PID']."_cost"];
			$PID = $row['PID'];
			$itemtotal = $quan*$cost;
			if ($quan > 0) {
				$sql2 = "Insert Into IrisSaleCalc (TID, PID, cost, quant, itemtotal) values ('$TID','$PID','$cost','$quan','$itemtotal')";
				$rs2 = $conn->query($sql2) or die ("Sold products insert/update query failed");
			}
		}
	}
}
//by this point all sold products' amounts and such are recorded with the $TID for the record. TRANSACTION OVER.

print $PageHeader; 

print $Navigation;

//no post information, just DB
if (isset ($CID)){
	$sql = "UPDATE IrisAccount SET history = 1 WHERE CID = '$CID'";
	$rs = $conn->query($sql) or die ("Account's second insert/update query failed");
	print "<h1>Submission accepted.</h1>";
} else {print "Temporary accounts have no history.<br>";}
//History activation end

$sql = "SELECT * FROM IrisProducts order by PID ASC";
$rs = $conn->query($sql) or die ("query failed");
print "<table class='products'>";
while ($row = $rs->fetch_assoc()){
	$quan=$_POST[$row['PID']."_quan"];//do these need {}s around the interior?
	$cost=$_POST[$row['PID']."_cost"];
	if ($quan > 0) {
		print "<tr><td><img src='./products/".$row['img']."' alt='".$row['item']."'</td>
			<td>".$row['item']."</td>
			<td>Amount Ordered: ".$quan."</td>
			<td>After discount price: ".$cost."</td></tr>";
	}
}
print "<tr><td> Total Cost: $ ".$_POST['totalcost']."</td>
	<td> Date and time chosen: ".$_POST['monthset']." / ".$_POST['dayset']." at ".$_POST['timeset']."</td></tr>";
print "</table>";
print $PageFooter;?>
