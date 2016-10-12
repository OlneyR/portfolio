<?include("shared.php");?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Booking</title>
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
</head>

<body>

<? print $Header;?>

<? print $Navigation;?>

<div id="address" >
				<p>We are only taking orders up to the end of next month at this time.
       <br>On the 1st of every month orders will be accepted for the new upcoming month.
       <br>The following is the currently scheduled list. No catering is available on already-scheduled days.
       <br>
</p>
<ul>
       <li>December 15- Company name here</li><br>
       <li>December 18- Company name here</li><br>
       <li>December 23- Company name here</li><br>
       <li>December 27- Company name here</li><br>
       <li>January 11- Company name here</li><br>
</ul>
<p>You can request our catering service for your company or organization below.<br>
</p>

<form action="" method="POST">
       <input type='text' name='company'>
       <br>
       <input type='tel' placeholder='Format: 1234567890' name='phone'>
       <br>
       <input type='datetime-local' name='datetime'>
       <br>
       <input type='submit' name='Submit' value='Send request'>
</form>
</div>


<? print $Footer;?>

</body>
</html>