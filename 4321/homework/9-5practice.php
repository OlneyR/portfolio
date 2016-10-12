<?php

function multTable($n){
	echo "<table border = '1'>";
	for ($o=1; $o<=9; $o++){
		$p = $o * $n;
		echo "<tr><td>$n * $o = $p</td></tr>";
	}
	echo "</table>";
}

	for ($a=3;$a<7;$a++){
		multTable($a);
	}
?>
<!-- -><- -->
