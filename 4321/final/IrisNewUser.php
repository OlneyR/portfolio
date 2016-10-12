<?php

include("shared.php");
print $PageHeader;
print $Navigation;
?>

	<form action="create.php" method="POST">
		<table>
			<tr><td>First Name:</td>
				<td><input type="text" name="Fname" size="20" value=""></td></tr>
			<tr><td>Last Name:</td>
				<td><input type="text" name="Lname" size="20" value=""></td></tr>
			<tr><td>Email</td>
				<td><input type="text" name="email" size="40" value=""></td></tr>
			<tr><td>Password</td>
				<td><input type="password" name="pass" size="20" value=""></td></tr>
			<tr><td colspan=2><input type="submit" name="Submit" value="Make Account"></td></tr>
		</table>
	</form>

<?php print $PageFooter;?>
