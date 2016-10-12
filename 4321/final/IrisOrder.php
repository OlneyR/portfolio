<?php
include("../../../includes/dbconn.inc.php"); //db connection
include("shared.php");
$conn = dbConnect();
//end connections


function counter(){
	$numbers ="<option value='0' selected>0</option>";
	for ($x=1; $x<=25; $x++) {
		$numbers .= "<option value='$x'>$x</option>";
	}
	return $numbers;
}

function month(){
	$month ="<option value='1' selected>1</option>";
	for ($m=2; $m<=12; $m++) {
		$month .= "<option value='$m'>$m</option>";
	}
	return $month;
}

function day(){
	$day ="<option value='1' selected>1</option>";
	for ($d=2; $d<=31; $d++) {
		$day .= "<option value='$d'>$d</option>";
	}
	return $day;
}

function times(){
	$times ="<option value='530' selected>530</option>";
	$time = 530;
	$minutes = "30";
	$hours = 5;
	while ($time <= 1400) {
		$minutes += "15";
		if ($minutes == "60") {
			$minutes = "00";
			$hours +=1;
		}
		$time = $hours.$minutes;
		$time = intval($time);
		$times .= "<option value='$time'>$time</option>";
	}
	return $times;
}



print $PageHeader; 
print $Navigation;

if (isset($_SESSION['id'])) {
	$CID = $_SESSION['id'];//CID get in cases of account
}


print "<form action='IrisProcessing.php' method='POST'>";
print "<table class='products'>";
if (!isset($CID)) {
	print "<p>Temp Accounts cannot access history. Write your order info down after confirmation.</p><br>";
	print "<tr><td>First Name:</td>
				<td><input type='text' name='Fname' size='20' value=''></td></tr>
			<tr><td>Last Name:</td>
				<td><input type='text' name='Lname' size='20' value=''></td></tr>
			<tr><td>Email</td>
				<td><input type='text' name='email' size='40' value=''></td></tr>";
}
$sql = "SELECT * FROM IrisProducts order by PID ASC";//repeat this in PROCESSING file, removing table and making input areas contain $_POST information
$rs = $conn->query($sql) or die ("query failed");
while ($row = $rs->fetch_assoc()){
	$cost = ($row['price'] - ( $row['price'] *(($row['sale']) / 100)));
	$cost = round( $cost, 2 );
	$price = round( $row['price'], 2 );
	print "<tr><td><img src=\"./products/".$row['img']."\" alt=\"".$row['item']."\"</td>
	<td>".$row['item']."</td>
	<td>".$row['info']."</td>
	<td>$".$price."</td>
	<td>".$row['sale']."% off</td>
	<td><select name='".$row['PID']."_quan'>".counter()."</select></td>
	<td><input name='".$row['PID']."_cost' type='hidden' value='".$cost."'></td></tr>";
}
print "<tr><td>Select Month: </td><td><select name='monthset'>".month()."</select></td></tr>
<tr><td>Select Day: </td><td><select name='dayset'>".day()."</select></td></tr>
<tr><td>Select Time: </td><td><select name='timeset'>".times()."</select></td></tr>";

print "<tr><td colspan = 5><input type='submit' name='Submit' value='Finalize Order'></td></tr>";
print "</table></form>";
print $PageFooter; ?>
