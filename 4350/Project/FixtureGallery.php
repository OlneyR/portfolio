<!DOCTYPE HTML>
<HTML>
<HEAD>
<TITLE>Dallas Fixture Gallery</TITLE>
<meta charset="UTF-8">
<meta name="description" content="Custom fixtures for medical, retail, or industrial placement, located in Dallas">
<meta name="keywords" content="Fixtures, Fixture, Dallas, Medical, Retail, Custom, Woodwork">
<meta name="author" content="Richard Olney">
<link rel="stylesheet" type="text/css" href="Fixture.css" media="screen and (min-width:481px)">
<link rel="stylesheet" href="FixtureMobile.css" media="screen and (max-width: 480px)">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style type="text/css"></style>
<script>
	function init(evt){
		selection(0,evt);
		var submenuArr = document.getElementsByClassName('submenu');

		for(i=0;i<(submenuArr.length);i++){
			//console.log("i: " + i);
			submenuArr[i].onclick = function(evt){selection(this.getAttribute('value'), evt)};
			//historical note: this.getAttribute('value') was previously just (i,evt) but kept returning the array length for no reason at all.
		}

	}

	function selection(position, e){

		if (window.XMLHttpRequest){
			xmlhttp=new XMLHttpRequest();}
		else{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
		if (!e) var e = window.event;
		if (xmlhttp)
		{e.preventDefault();
		}else{return;}

		xmlhttp.onreadystatechange=function(){
			console.log("position: " + position+ "  " + xmlhttp.readyState);
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
				console.log(xmlhttp.responseText);
		    	document.getElementById('samples').innerHTML=xmlhttp.responseText;
		    }
		}
		xmlhttp.open("GET","FixtureData.php?t="+position,true);
		xmlhttp.send();

	}
window.onload = init;
</script>

</HEAD>
<BODY>
<?php include ("FixtureShared.php");
include ("../../../includes/dbconn.inc.php");
$conn = dbConnect();
//end connections




print "<div id='wrapper'>";
print $pageHeader;
//begin subnav
$sql = "SELECT * FROM FGalleryType order by TID ASC";
$rs = $conn->query($sql) or die ("Query Failed.");
print "<div class='subnav'><ul><li><a class='submenu' value='0' id='defaultload' href='./FixtureGallery.php?t=0'>All</a></li>";//add in head:submenu onclick function
while ($row = $rs->fetch_assoc()){
	//print "<script>console.log('subnav calcing');</script>";crumbs
	$categ = $row['type'];
	print "<li><a class='submenu' value='".$row['TID']."' href='./FixtureGallery.php?t=".$row['TID']."'>".$categ."</a></li>";
}
print "</ul></div>";
//end subnav
?>
<article id="samples">

</article>
<?print $pageCopyright;?>
</div>

</BODY>
</HTML>
