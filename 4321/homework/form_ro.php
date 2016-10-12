<?php

	if (array_key_exists('register',$_POST)){
		$expected = array("firstName","lastName","dest","month","day","reqs","textarea");
		$required = array("firstName","lastName","dest","month","day","reqs");
		$missing = array();
		foreach ($expected as $fieldName){
			if(isset($_POST[$fieldName])){
				$value = $_POST[$fieldName];
			} else {
				$value = "";
			}
			if (is_array($value)){$value = implode(", ",$value);}
			$temp = trim($value);
			if ( empty($temp) && in_array($fieldName,$required)){
				$alias= $fieldName;
				if ($fieldName == "firstName")
					{$alias="First Name";}
				if ($fieldName == "lastName")
					{$alias="Last Name";}
				if ($fieldName == "dest")
					{$alias="Destination";}
				if ($fieldName == "month")
					{$alias="Departure Month";}
				if ($fieldName == "day")
					{$alias="Departure Day";}
				if ($fieldName == "reqs")
					{$alias="Reservations";}
				array_push ($missing, $alias);
			}
		}
		if (empty($missing)){
			$output = "You have submitted the following information:<br><br>";
			$output .= "<table border='1'>";

			foreach($expected as $fieldName){
				$value = $_POST[$fieldName];

				if (empty($value)){
					$value = "(No input)";
				} else {
					if (is_array($value)){
						$value = implode(", ",$value);
					} else {
						$value = htmlentities($value);
						$value = nl2br($value);
					}
				}
				$alias= "";
				if ($fieldName == "firstName")
					{$alias="First Name";}
				if ($fieldName == "lastName")
					{$alias="Last Name";}
				if ($fieldName == "dest")
					{$alias="Destination";}
				if ($fieldName == "month")
					{$alias="Month";}
				if ($fieldName == "day")
					{$alias="Day";}
				if ($fieldName == "reqs")
					{$alias="Requested";}
				if ($fieldName == "textarea")
					{$alias="Notes";}

				$output .= "<tr><td><b>$alias</b></td><td>$value</td></tr>";
			}
			$output .= "</table>";
		} else {
			$output = "These required fields are not filled:<br>\n<ul>";
			foreach($missing as $m) {
				$output .= "<li>$m</li>";
			}
			$output .= "</ul>";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
<title>form assignment</title>
</head>

<body>
	<div id="header">
		<h3> Form Assignment </h3>
			<hr>
	</div>
	<div id="registration">
		<?php
			echo $output;
			echo "<hr>";
		?>
		<form action="" method="post">
		*All fields are required.<br><br>

		First name: <input type="text" name="firstName" value="<?php if (!empty($missing)) {echo htmlentities($_POST['firstName']);} ?>"><br>
		Last name: <input type="text" name="lastName" value="<?php if (!empty($missing)) {echo htmlentities($_POST['lastName']);} ?>"><br>
		
		Destination: 
		<?php
			function radioChecked($fieldName,$v){
				global $missing;
				if (isset($_POST[$fieldName])&&(!empty($missing))&&$_POST[$fieldName] == $v)
					{$checked = "checked";} else {$checked = "";}
				echo $checked;
			}
		?>
		<input type="radio" name="dest" value="Florida" <?php radioChecked('dest','Florida') ?>> Florida
		<input type="radio" name="dest" value="Hawaii" <?php radioChecked('dest','Hawaii') ?>> Hawaii
		<input type="radio" name="dest" value="US Virgin Islands" <?php radioChecked('dest','US Virgin Islands') ?>> US Virgin Islands<br>

		Departure Date:
		<?php
			function dropListChecked($fieldName,$v){
				global $missing;
				if (isset($_POST[$fieldName])&&(!empty($missing))&&$_POST[$fieldName] == $v)
					{$checked = "selected";} else {$checked = "";}
				echo $checked;
			}
		?>
		<select name="month">
			<option value="January" <?php dropListChecked('month','Jan') ?>>Jan</option>
			<option value="February" <?php dropListChecked('month','Feb') ?>>Feb</option>
			<option value="March" <?php dropListChecked('month','Mar') ?>>Mar</option>
			<option value="April" <?php dropListChecked('month','Apl') ?>>Apl</option>
			<option value="May" <?php dropListChecked('month','May') ?>>May</option>
			<option value="June" <?php dropListChecked('month','Jun') ?>>Jun</option>
			<option value="July" <?php dropListChecked('month','Jul') ?>>Jul</option>
			<option value="August" <?php dropListChecked('month','Aug') ?>>Aug</option>
			<option value="September" <?php dropListChecked('month','Sep') ?>>Sep</option>
			<option value="October" <?php dropListChecked('month','Oct') ?>>Oct</option>
			<option value="November" <?php dropListChecked('month','Nov') ?>>Nov</option>
			<option value="December" <?php dropListChecked('month','Dec') ?>>Dec</option>
		</select>

		<?php
			echo '<select name="day">';
			for($d=1;$d<=31;$d++){
				echo "<option value=$d".dropListChecked('day',$d).">$d</option>";
			}
			echo "</select>";
		?>


		Reservations:
		<?php
			function reqsChecked($v){
				global $missing;
				if (isset($_POST['reqs'])&&(!empty($missing))&&in_array($v,$_POST['reqs']))
					{$checked = "checked";} else {$checked = "";}
				echo $checked;
			}
		?>
		<input type="checkbox" name="reqs[]" value="Flights" <?php reqsChecked('Flights')?>> Flights
		<input type="checkbox" name="reqs[]" value="Hotels" <?php reqsChecked('Hotels')?>> Hotels 
		<input type="checkbox" name="reqs[]" value="Cars" <?php reqsChecked('Cars')?>> Cars<br>

		Special Instruction:
		<textarea name="textarea" rows="7" cols="45"><?php if (!empty($missing)) {echo $_POST['textarea'];} ?></textarea>
		<br>
		<input type="Submit" name="register" value="register">
		</form>
	</div>

	</body>
</html>