<?php
include("../../../includes/dbconn.inc.php"); //db connection
include("shared.php");
$conn = dbConnect();



if (array_key_exists('login', $_POST)){
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$sql = "SELECT * FROM IrisAccount WHERE email = '$email' AND pass = '$pass'";
	$rs = $conn->query($sql) or die ("query failed");

	while ($row = $rs->fetch_assoc()){
		$_SESSION['id'] = $row['CID'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['Fname'] = $row['Fname'];
		$_SESSION['Lname'] = $row['Lname'];
		$_SESSION['pass'] = $row['pass'];
		if ($row['history'] == 1)
			{$_SESSION['history']=1;}
		else {$_SESSION['history']=0;}
	}
}
print $PageHeader;
print $Navigation;
if (isset($_SESSION['id'])){
	print "<p>You are logged in.</p>";
} 
else {
print "
	<form id='login' name='login' method='post' action=''>
		<p>
			<label for='email'>Email:</label>
			<input type='text' name='email' id='email' /><br>
			<label for='pass'>Password:</label>
			<input type='password' name='pass' id='pass'/>
		</p>
		<p>
			<input type='submit' name='login' value='Log In &gt;'/>
			<br><a href='IrisNewUser.php'>New Account</a>
		</p>
	</form>";}
print $PageFooter;

?>
