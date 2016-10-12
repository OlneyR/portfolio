<?php
//--------------------------
// Form Processing Script
//		This script is written to work with the form in post_form.php.
//--------------------------

// set up variables to store all user input
$author = $_POST['author'];
$title = $_POST['title'];
$comment = $_POST['comment'];
$tags = $_POST['tags'];
$email = $_POST['email'];
$taglist = implode(", ",$tags);
// use a variable to store the output.  The output ($output) will be printed below (line 34). 

$output = "<table border='1'><tr>
<td><b>Author</b>: $author <br/></td>
<td><b>Email</b>: $email <br/></td>
</tr><tr><td><b>Title</b>: $title <br/></td>
<td><b>Tags</b>: $taglist <br/></td>
<td><b>Comment</b>: $comment <br/></td>
</tr></table>";

	   
?>

<!DOCTYPE HTML>
<HTML>
<HEAD>
<TITLE> CTEC 4309 Class Working File: Message Form Processing</TITLE>
</HEAD>

<BODY>
CTEC 4309 Class Working File 
<hr>

<h2>Preview Your Message</h2>

<hr size="1">
<p>
	<?php echo $output;

	?>

</p>


</BODY>
</HTML>
