<?php

for ($i=10; $i<=100; $i=$i+10){
	$e = $i/10;

	echo "$i bonus points for $e entry/entries<br>";
}


echo "<br>Part II<br>Forwards<br>";

for ($a=1; $a<=9; $a=$a+1){
	$b = $a * 2;
	echo "2 * $a = $b <br>";
}

echo "And written backwards +changed to 3s<br>";

for ($c=3; $c<=27; $c=$c+3){
	$d = $c / 3;
	echo "3 * $d = $c <br>";
}

echo "4s + table<br>";

echo "<table border = '1'>";
	for ($t=4; $t<=36; $t=$t+4){
		$u = $t / 4;
		echo "<tr><td>4 * $u = $t</td></tr>";
	}
echo "</table>";

?>
<!-- -><- -->