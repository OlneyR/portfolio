<!DOCTYPE HTML>
<HTML>
<HEAD>
<TITLE>Dallas Fixture Testimonials</TITLE>
<meta charset="UTF-8">
<meta name="description" content="Custom fixtures for medical, retail, or industrial placement, located in Dallas">
<meta name="keywords" content="Fixtures, Fixture, Dallas, Medical, Retail, Custom, Woodwork">
<meta name="author" content="Richard Olney">
<link rel="stylesheet" type="text/css" href="Fixture.css" media="screen and (min-width:481px)">
<link rel="stylesheet" href="FixtureMobile.css" media="screen and (max-width: 480px)">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style type="text/css"></style>
<?php
	include ("FixtureShared.php");
	include ("../../../includes/dbconn.inc.php");
	$conn = dbConnect();
?>

</HEAD>

<BODY>

<div id="wrapper">
	<? print $pageHeader?>

	<article id="testimonials">
	<?php
		$sql="SELECT * FROM FTestimonial order by TSID ASC";
		$rs = $conn->query($sql) or die ("Query Failed.");
		while ($row = $rs->fetch_assoc()){
			//printing list of testimonials
			print "
				<section id='".$row['TSID']."'>
					<div class='tesm-text'>
						<h2>".$row['company']."</h2>
						<h3>".$row['name']."</h3>
						<p>".$row['quote']."</p>
					</div>
					<img src='./images/thumb-".$row['image']."' class='tesm-img'><br class='clear'>
				</section>
			";
		}

	?>
	</article>

	<? print $pageCopyright?>
</div>

</BODY>
</HTML>
