<!DOCTYPE HTML>
<HTML>
<HEAD>
<TITLE> CTEC 4309 Class Working File: Message Posting Form</TITLE>
</HEAD>

<BODY>
CTEC 4309 Class Working File 
<hr>

<h2>Post a Message</h2>

<hr size="1">

<h3>Message Form</h3>
 <form action= "post.php" method="post">
	Author: <input type='text' name='author'><br/>
	Email: <input type='text' name='email'><br/>
	Title: <input type='text' name='title'><br/>
	Tags: <input type='checkbox' name='tags[]' value='General Interest'/>General Interest
	<input type='checkbox' name='tags[]' value='Local School'/>Local School
	<input type='checkbox' name='tags[]' value='Safety'/>Safety<br/>
	Comment: <br/><textarea name="comment" rows="5" cols="40"></textarea><br/>
	<input type="Submit" name="SubmitThis" value="Preview">
  </form>



</BODY>
</HTML>
