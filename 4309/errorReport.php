<?php

// Original script from http://bg2.php.net/error_reporting user submitted comment 8/15/2008
// Modified by CYJ

$badfile = "";
 if (array_key_exists('badfile',$_GET)){
	 $badfile=$_GET[badfile]; // URL looks like this: http://mydomain.com/debug.php?badfile=problempage.php
	 echo "$badfile<hr>";
	 error_reporting(E_ALL);
     ini_set("display_errors", 1);
     include("$badfile");
 }


?>
<p>
<form action="" method="get">
Bad file to be examined : (supply relative path)<br>
<input type="text" name="badfile" value="<?php echo $badfile;?>" size=45> <input type="Submit" name="Submit" value="Submit">
</form>
</p>