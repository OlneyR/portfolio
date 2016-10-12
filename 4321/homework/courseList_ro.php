<?php

// Below is a multi-dimensional array storing information about classes.  If the array is modified, a minor deduction will be applied.
$classes = array ();
	$classes[0] = array();
		$classes[0]['Prefix'] = "CTEC";
		$classes[0]['Number'] = "2350";
		$classes[0]['Title'] = "Intro to Communication Technology";
		$classes[0]['Room'] = "FAB 412";
	$classes[1] = array();
		$classes[1]['Prefix'] = "CTEC";
		$classes[1]['Number'] = "3350";
		$classes[1]['Title'] = "Website Communication";
		$classes[1]['Room'] = "FAB 411";
	$classes[2] = array();
		$classes[2]['Prefix'] = "BCMN";
		$classes[2]['Number'] = "3319";
		$classes[2]['Title'] = "Broadcast Management";
		$classes[2]['Room'] = "FAB 327";
	$classes[3] = array();
		$classes[3]['Prefix'] = "BCMN";
		$classes[3]['Number'] = "3340";
		$classes[3]['Title'] = "Electronic News";
		$classes[3]['Room'] = "FAB 112";
	$classes[4] = array();
		$classes[4]['Prefix'] = "ADVT";
		$classes[4]['Number'] = "4305";
		$classes[4]['Title'] = "Advertising Media";
		$classes[4]['Room'] = "FAB 409";
?>		

<?php
if (array_key_exists('show',$_POST)){//supposed to access form's input
	$value = $_POST[level];//futile attempt to make work
	if ($value == "ALL"){//inefficient but functional breakdown of inputs, but expandable (not bound to 0-4 array positions)
		foreach ($classes as $class){//go through every class
			echo "<table border='1'>";
			echo "<tr><td><b>Course Number</b></td> <td><b>Title</b></td> <td><b>Room</b></td></tr>";
			echo "<tr><td>".$class['Prefix'].$class['Number']."</td><td>".$class['Title']."</td><td>".$class['Room']."</td></tr>";
			echo "</table>";
		}
	}
	if ($value == "1000"){
		foreach ($classes as $class){
			if ($class['Number']<"2000"&&$class['Number']>"999"){//go through classes lower than 2000, higher than 999
				echo "<table border='1'>";
				echo "<tr><td><b>Course Number</b></td> <td><b>Title</b></td> <td><b>Room</b></td></tr>";
				echo "<tr><td>".$class['Prefix'].$class['Number']."</td><td>".$class['Title']."</td><td>".$class['Room']."</td></tr>";
				echo "</table>";
			}
		}
	}
	if ($value == "2000"){
		foreach ($classes as $class){
			if ($class['Number']<"3000"&&$class['Number']>"1999"){//go through classes lower than 3000, higher than 1999
				echo "<table border='1'>";
				echo "<tr><td><b>Course Number</b></td> <td><b>Title</b></td> <td><b>Room</b></td></tr>";
				echo "<tr><td>".$class['Prefix'].$class['Number']."</td><td>".$class['Title']."</td><td>".$class['Room']."</td></tr>";
				echo "</table>";
			}
		}
	}
	if ($value == "3000"){
		foreach ($classes as $class){
			if ($class['Number']<"4000"&&$class['Number']>"2999"){//go through classes lower than 4000, higher than 2999
				echo "<table border='1'>";
				echo "<tr><td><b>Course Number</b></td> <td><b>Title</b></td> <td><b>Room</b></td></tr>";
				echo "<tr><td>".$class['Prefix'].$class['Number']."</td><td>".$class['Title']."</td><td>".$class['Room']."</td></tr>";
				echo "</table>";
			}
		}
	}
	if ($value == "4000"){
		foreach ($classes as $class){
			if ($class['Number']>"3999"&&$class['Number']<"5000"){//go through classes lower than 5000, higher than 3999
				echo "<table border='1'>";
				echo "<tr><td><b>Course Number</b></td> <td><b>Title</b></td> <td><b>Room</b></td></tr>";
				echo "<tr><td>".$class['Prefix'].$class['Number']."</td><td>".$class['Title']."</td><td>".$class['Room']."</td></tr>";
				echo "</table>";
			}//each should be printing appropriate classes info per row
		}//end foreach
	}//end if
}//end greater if
//not missing any {}s
?>
<!DOCTYPE html>
<html>
<head>
<title>CTEC 4321 Exam #1</title>
</head>

<body>
<div id="header">
    <h3> CTEC 4321 Exam #1 Part II: Hands-on Test </h3>
	<hr>
</div>
<div id="Form">

 <b>Class List</b>
  <form action="" method="post">
	Please select a course level: 

	<select name="level">
		<option value="ALL">ALL</option>
		<option value="1000">1000 Level</option>
		<option value="2000">2000 Level</option>
		<option value="3000">3000 Level</option>
		<option value="4000">4000 Level</option>
	</select>
	<input type="Submit" name="show" value="Show Courses">
  </form>

<hr>


</div>
</body>
</html>
