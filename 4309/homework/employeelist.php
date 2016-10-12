<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> CTEC 4309: Employee List Exercise </TITLE>
</HEAD>

<BODY>
<?php
	$empArr = array();
	$empArr['M3004342'] = "Andrew";
	$empArr['M4004342'] = "Beth";
	$empArr['M3008372'] = "Chris";
	$empArr['M3004342'] = "Daniel";
	$empArr['M4009972'] = "Flora";

	echo "<ul>";
	foreach ($empArr as $f => $g) {
		echo "<li>";
		echo "$f<br>";
		echo "$g";
		echo"</li>";
	}
	echo "</ul>";

	
?>
</BODY>
</HTML>