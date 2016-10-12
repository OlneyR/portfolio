<?php

function makeHeader ($page) {

	if ($page == 'home') {
		$class = 'homeHeader';
	} else {
		$class = 'otherHeader';
	}

	$header = "<h1 class='$class'>A Fake Site</h1>\n<h3>For CTEC 4309 PHP Exercise Only</h3>\n";

	return $header;
}
function makeMenu ($page) {
			
	if ($page == "home") {
			$classH= "highlight";
	} else {
			$classH = "normal";
	}
	
	if ($page == "links") {
			$classL= "highlight";
	} else {
			$classL= "normal";
	}

	if ($page == "assignment") {
			$classA= "highlight";
	} else {
			$classA = "normal";
	}
		
	$menu ="| <a href='home.php' class='$classH'>Home</a> | <a href='assignment.php' class='$classA'>Assignment</a> | <a href=\"links.php\" class='$classL'>Links</a> |";
	
	return $menu;
}
?>