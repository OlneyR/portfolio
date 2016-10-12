<?php
include("../../../includes/dbconn.inc.php"); //db connection
include("shared.php");
$conn = dbConnect();
//end connections


print $PageHeader; 
print $Navigation;


if (isset($_POST['Submit'])) {
	nukeMagicQuotes();
	$required = array("email","pass");
	$expected = array("email","pass","Fname","Lname");
	$missing = array();
	foreach ($expected as $field){
		if (in_array($field, $required) && (!isset($_POST[$field]) || empty($_POST[$field]))) {
			array_push ($missing, $field);
		} else {
			if (!isset($_POST[$field]) || empty($_POST[$field])) {
				${$field} = "Nope";
			} else {
				${$field} = quote_smart($_POST[$field]);
			}
		}
	}
}//end $_POST to variable conversion

if (empty($missing)) {//potentially make sql check for prescence of email in DB already, later
	$sql ="SELECT * FROM IrisAccount WHERE email = '$email'";
	$rs = $conn->query($sql) or die ("previous acct check 1 failure");
	$number = $rs->num_rows;
	if ($number == 0) {
		$sql="INSERT INTO IrisAccount (email, pass, Fname, Lname) values ('$email','$pass','$Fname','$Lname')";
		$rs = $conn->query($sql) or die ("insert/update to accounts query failed");
		$sql = "SELECT * FROM IrisAccount WHERE email = '$email'";
		$rs = $conn->query($sql) or die ("accounts check failed");
		while ($row = $rs->fetch_assoc()) {
			print "Account created for user ".$email;
			$_SESSION['id'] = $row['CID'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['Fname'] = $row['Fname'];
			$_SESSION['Lname'] = $row['Lname'];
			$_SESSION['pass'] = $row['pass'];
			$_SESSION['history'] = $row['history'];
			print "<br><h1>Now logged in.</h1>";
		}
	} else {echo "Email already used. Use another. No password recovery will be made.";}
}
?>
<?php print $PageFooter;?>
