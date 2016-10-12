<!DOCTYPE HTML>
<HTML>
<HEAD>
<TITLE> CTEC 4309 Class Working File: Posting a Message </TITLE>
</HEAD>

<BODY>
CTEC 4309 Class Working File 
<hr>

<h2>Post a Message</h2>

<hr size="1">

<h3>Form</h3>
* required fields
 <form action= "post3.php" method="post">
	Author * : <input type="text" name="author"><br/>
	Email : <input type="text" name="email"><br/>
	Title * : <input type="text" name="title"><br/>
	
	Tag: 
	<input type="checkbox" name="tag[]" value="General Interests"> General Interests
	<input type="checkbox" name="tag[]" value="Local Schools"> Local Schools
	<input type="checkbox" name="tag[]" value="Safety"> Safety
	<br/>

	Background color:
	<input type="radio" name="background_color" value="">None<br>
	<input type="radio" name="background_color" value="blue">Blue<br>
	<input type="radio" name="background_color" value="orange">Orange<br>

	Comment * : <br/><textarea name="comment" rows="5" cols="40"></textarea><br>
	<input type="Submit" name="SubmitThis" value="Preview">
  </form>



</BODY>
</HTML>