<!DOCTYPE HTML>
<HTML>
<HEAD>
<TITLE>Dallas Fixture Contact</TITLE>
<meta charset="UTF-8">
<meta name="description" content="Custom fixtures for medical, retail, or industrial placement, located in Dallas">
<meta name="keywords" content="Fixtures, Fixture, Dallas, Medical, Retail, Custom, Woodwork">
<meta name="author" content="Richard Olney">

<meta content="width=device-width, initial-scale=1.0" name="viewport"></meta>

<link rel="stylesheet" type="text/css" href="Fixture.css" media="screen and (min-width:481px)">
<link rel="stylesheet" href="FixtureMobile.css" media="screen and (max-width: 480px)">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style type="text/css"></style>

<?php include ("FixtureShared.php");?>
<script>
/*	function init() {
		var boxesArr = document.getElementsByClassName('contacts') = function(){focus};

	*//*for(i=0;i<(boxesArr.length);i++){
			//console.log("i: " + i);
			boxesArr[i].onfocus = function(){focus};
		}*//*
	}
	
	function focus() {
		this.style.border= "3px solid #70DBDB";
	}
window.onload = init;*/

//This would highlight the selected field, but refuses to work because init is alternating between invalid left-hand and not being a valid function
</script>
</HEAD>

<BODY>

<div id="wrapper">
	<? print $pageHeader?>
	<div id="contactform">
		
		<?php
		// display form if user has not clicked submit
		if (!isset($_POST["submit"]))
			{
			?><h2 id='formh2'>Contact Us with the following form</h2>
			<form id="contact" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
			From: <br><input class="contacts" type="text" name="from"><br>
			Email: <br><input class="contacts" type="email" name="email" required><br>
			<p>Interests:<br>(Please select the choice that fits your message best.)</p>
			<input type="checkbox" name="interest[]" value="Testimonial Submission" id="interest_tes">
				<label for="interest_tes">Testimonial Submission</label>
			<input type="checkbox" name="interest[]" value="Service Request" id="interest_ser">
				<label for="interest_ser">Service Request</label>
			<input type="checkbox" name="interest[]" value="Feedback" id="interest_fed">
				<label for="interest_fed">Feedback</label>
			<input type="checkbox" name="interest[]" value="Other" id="interest_oth">
				<label for="interest_oth">Other</label><br><br>
			Subject: <br><input class="contacts" type="text" name="subject"><br>
			Message: <br><textarea  class="contacts" rows="14" name="message" required></textarea><br>
			<input type="submit" name="submit" value="Submit Feedback">
			</form>
			<?php
			}
		else
		// the user has submitted the form
		{
		// Check if the "from" input field is filled out
			if ($_POST["email"]==''){print "<h2 id='formh2'>You must provide an email address.</h2>";}
			else if (!isset($_POST["subject"])){print "<h2 id='formh2'>You must provide a message to send.</h2>";}
			else{
				$from = $_POST["email"];
				$subject = $_POST["subject"]; 
				
				$interest = $_POST["interest"];
				$interest = implode(', ', $interest);
				$message = $interest."\n\n";
				$message.= $_POST["message"];
				$message.= "\nFrom: ".$_POST["from"];
				// message lines should not exceed 70 characters (PHP rule), so wrap it
				$message = wordwrap($message, 70);
				// send mail
				mail("richard.olney@mavs.uta.edu",$subject,$message,"From: $from\n");
				print "<h2 id='formh2'>Thank you for your submission</h2>";
				print "<div id='tytext'>Message Sent</div>";
			}
		}
		?>
		<div id="contactinfo">
			To contact us by phone, call:<br>
			Edrea Au 682-553-8886 (Don't. This is a class project.)
		</div>
	</div>
	<?print $pageCopyright;?>
</div>

</BODY>
</HTML>
