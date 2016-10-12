<?php
include("../../../includes/dbconn.inc.php"); //db connection
include("shared.php");
$conn = dbConnect();
function counter(){
	$numbers ="<option value='0' selected>0</option>";
	for ($x=1; $x<=25; $x++) {
		$numbers .= "<option value='$x'>$x</option>";
	}
	return $numbers;
}


?>
<?include("shared.php");?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Online Orders</title>
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
</head>

<body>

<? print $Header;?>

<? print $Navigation;?>


<div id="orders">
				
<form action='CandyProcessing.php' method='POST'>
<table id='products'>
<?php
$sql = "SELECT * FROM CandyProducts order by PID ASC";//repeat this in PROCESSING file, removing table and making input areas contain $_POST information
$rs = $conn->query($sql) or die ("query failed");
while ($row = $rs->fetch_assoc()){
	print "<tr><td><img src=\"./products/".$row['img']."\" alt=\"".$row['item']."\"</td>
	<td>".$row['item']."</td>
	<td>".$row['info']."</td>
	<td>$".$row['price']."</td>
	<td><select name='".$row['PID']."_quan'>".counter()."</select></td>
	</tr>";
}
?>
	<tr><td colspan = 2><input type='tel' placeholder='Format: 1234567890' name='phone'></td><td colspan = 3><input type='datetime-local' name='datetime'></td></tr>
	<tr><td colspan = 5><input type='submit' name='Submit1' value='Finalize Order'></td></tr>
</table></form>


</div>


<? print $Footer;?>

</body>
</html>
