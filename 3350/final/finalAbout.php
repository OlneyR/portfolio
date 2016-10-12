<!doctype html>
<html>

<head>
	
	<title>Final Contact</title>
	<link rel="stylesheet" type="text/css" href="final.css">
	<link rel='stylesheet' media='screen and (max-width: 480px)' href='finalmobile.css' />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
		function nukeMagicQuotes() {
		  if (get_magic_quotes_gpc()) {
			function stripslashes_deep($value) {
			  $value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
			  return $value;
			  }
			$_POST = array_map('stripslashes_deep', $_POST);
			$_GET = array_map('stripslashes_deep', $_GET);
			$_COOKIE = array_map('stripslashes_deep', $_COOKIE);
			}
		}
		// THIS IS THE ERROR CHECKING SECTION. YOU SHOULD PLACE THIS IN THE HEAD SECTION
		// BE SURE TO CUSTOMIZE THE AREAS FOR YOUR WEBSITE

		if (function_exists('nukeMagicQuotes')) {
		  nukeMagicQuotes();
		  }

		// process the email
		if (array_key_exists('send', $_POST)) {
		  
		  // ********************************  CHANGE THIS TO YOUR E-MAIL ********************************************//
		  $to = 'richard.olney@mavs.uta.edu'; // use your own email address
		  
		  // ******************************** YOU SHOULD CUSTOMIZE THIS **********************************************//
		  $subject = 'Feedback concerning Portfolio page';
		  



		  // list expected fields
		  // ******************************** CHANGE THE EXPECTED AND REQUIRED FIELDS FOR YOUR OWN NEEDS ******************************** //
		  // YOU SHOULD USE THE NAME ATTRIBUTES FROM THE FORM CONTROLS

		  $expected = array('fName', 'lName', 'email', 'comments', 'moreInfo', 'howhear');
		  // set required fields
		  $required = array('fName', 'lName', 'email', 'moreInfo');
		  // create empty array for any missing fields
		  $missing = array();
		  
		  // assume that there is nothing suspect
		  $suspect = false;
		  // create a pattern to locate suspect phrases
		  $pattern = '/Content-Type:|Bcc:|Cc:/i';
		  
		  // function to check for suspect phrases
		  function isSuspect($val, $pattern, &$suspect) {
		    // if the variable is an array, loop through each element
			// and pass it recursively back to the same function
			if (is_array($val)) {
		      foreach ($val as $item) {
			    isSuspect($item, $pattern, $suspect);
			    }
			  }
		    else {
		      // if one of the suspect phrases is found, set Boolean to true
			  if (preg_match($pattern, $val)) {
		        $suspect = true;
			    }
			  }
		    }
		  
		  // check the $_POST array and any sub-arrays for suspect content
		  isSuspect($_POST, $pattern, $suspect);
		  
		  if ($suspect) {
		    $mailSent = false;
			unset($missing);
			}
		  else {
		    // process the $_POST variables
		    foreach ($_POST as $key => $value) {
		      // assign to temporary variable and strip whitespace if not an array
		      $temp = is_array($value) ? $value : trim($value);
			  // if empty and required, add to $missing array
			  if (empty($temp) && in_array($key, $required)) {
			    array_push($missing, $key);
			    }
			  // otherwise, assign to a variable of the same name as $key
			  elseif (in_array($key, $expected)) {
			    ${$key} = $temp;
			    }
			  }
			}
		  
		  // validate the email address
		  if (!empty($email)) {
		    // regex to ensure no illegal characters in email address 
			$checkEmail = '/^[^@]+@[^\s\r\n\'";,@%]+$/';
			// reject the email address if it doesn't match
			if (!preg_match($checkEmail, $email)) {
			  array_push($missing, 'email');
			  }
			}
		  
		  // go ahead only if not suspect and all required fields OK
		  if (!$suspect && empty($missing)) {
		    // set default values for variables that might not exist
			$subscribe = isset($subscribe) ? $subscribe : 'Nothing selected';
			$interests = isset($interests) ? $interests : array('None selected');
			$characteristics = isset($characteristics) ? $characteristics : array('None selected');
			
		    // build the message
		    $message = "Name: {$fName} {$lName}\n\n";
		    $message .= "Email: $email\n\n";
			$message .= 'Person would like more info about: '.implode(', ', $moreInfo)."\n\n";
			
			// ******* YOU CAN CUSTOMIZE THE NAME OF MY SITE TO YOUR OWN VERBIAGE
			$message .= "How you heard of my website: $howhear\n\n";
			$message .= "Additional comments: $comments";

		    // limit line length to 73 characters
		    $message = wordwrap($message, 73);
		    
			// create additional headers
			
			// ******************************** CHANGE THIS TO YOUR OWN E-MAIL ******************************** //
			$additionalHeaders = 'From: Richard Olney <richard.olney@mavs.uta.edu>';
			if (!empty($email)) {
			  $additionalHeaders .= "\r\nReply-To: $email";
			  }
			
		    // send it  
		    $mailSent = mail($to, $subject, $message, $additionalHeaders);
			if ($mailSent) {
			  // $missing is no longer needed if the email is sent, so unset it
			  unset($missing);
			  }
		    }
		  }
	?>
</head>

<body>

	<div id="container">
		<nav>
			<img id="logo" src="logo.png"/>
			<ul>
				<li><a href="finalHome.htm">Home</a></li>
				<li><a href="#">About</a></li>
				<li><a href="finalResume.htm">Resume</a></li>
				<li><a href="finalPortfolio.htm">Portfolio</a></li>
			</ul>
		</nav>
		<div id="content" class="form">
			<form id="feedback" method="post" action="" class="form-horizontal">
		        <fieldset id="contactInfo">
		            <!-- first name -->
		            <div class="control-group">
		                <label for="fName" class="control-label">First Name: <?php
		                if (isset($missing) && in_array('fName', $missing)) { ?>
		                <span class="warning">Please enter your <b>first name</b></span><?php } ?>
		                </label>
		                <div class="controls">
		                    <input name="fName" id="fName" type="text" class="formbox" 
		                    <?php if (isset($missing)) {
		                      echo 'value="'.htmlentities($_POST['fName']).'"';} ?>
		                    />
		                </div>
		            </div>
		    
		            <!-- last name -->
		            <div class="control-group">
		                <label for="lName" class="control-label">Last Name: <?php
		                if (isset($missing) && in_array('fName', $missing)) { ?>
		                <span class="warning">Please enter your <b>last name</b></span><?php } ?>
		                </label>
		                <div class="controls">
		                    <input name="lName" id="lName" type="text" class="formbox" 
		                    <?php if (isset($missing)) {
		                      echo 'value="'.htmlentities($_POST['lName']).'"';} ?>
		                    />
		                </div>
		            </div>
    
    
		            <!-- email -->
		    
		    
		            <div class="control-group">
		                <label for="e-mail" class="control-label">Email: <?php
		                if (isset($missing) && in_array('email', $missing)) { ?>
		                <span class="warning">Please enter your <b>email address</b></span><?php } ?>
		                </label>
		                <div class="controls">
		                    <input name="email" id="email" type="text" class="formbox" 
		                    <?php if (isset($missing)) {
		                      echo 'value="'.htmlentities($_POST['email']).'"';} ?>
		                    />
		                </div>
		            </div>
		        </fieldset><!-- end of first fieldset -->

		        <fieldset id="howHear">
		            <p class="lead">How did you find my portfolio page?
		                <select name="howhear" id="howhear">
		    
		                    <option value="No reply" 
		                    <?php
		                    if (!$_POST || $_POST['howhear'] == 'No reply') { ?>
		                    selected="selected"
		                    <?php } ?>
		                    >Select one</option>
		    
		                    <option value="word of mouth"
		                    <?php
		                    if (isset($missing) && $_POST['howhear'] == 'word of mouth') { ?>
		                    selected="selected"
		                    <?php } ?>
		                    >Word of mouth</option>
		    
		                    <option value="search engine"
		                    <?php
		                    if (isset($missing) && $_POST['howhear'] == 'search engine') { ?>
		                    selected="selected"
		                    <?php } ?>
		                    >Search Engine</option>
		    
		                    <option value="grading"
		                    <?php
		                    if (isset($missing) && $_POST['howhear'] == 'grading') { ?>
		                    selected="selected"
		                    <?php } ?>
		                    >You're grading this</option>
		    
		                    <option value="other"
		                    <?php
		                    if (isset($missing) && $_POST['howhear'] == 'other') { ?>
		                    selected="selected"
		                    <?php } ?>
		                    >Cat walked on keyboard</option>
		                </select>
		            </p>
		        </fieldset><!-- end of How Did you Hear About Us Section -->
    
		        <fieldset id="additionalComments">
		    
		            <p class="lead">
		                If you have any comments: add them to the comment box below. <?php
		                if (isset($missing) && in_array('comments', $missing)) { ?>
		                <span class="warning">Please enter your comments</span><?php } ?>
		                </label>
		                <textarea name="comments" id="comments" cols="60" rows="8" class="input-block-level"><?php 
		                if (isset($missing)) {
		                  echo htmlentities($_POST['comments']);
		                  } ?></textarea>
		            </p>
		        </fieldset>
		        <p>
		            <input name="send" id="send" type="submit" value="Send message" />
		        </p>
    		</form>
			<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			  ga('create', 'UA-40123073-1', 'uta.edu');
			  ga('send', 'pageview');

			</script>
		</div>
		<footer>
			Richard Chad Olney &copy; 2013
		</footer>
	</div>
    
</body>

</html>
<!-- -><- -->