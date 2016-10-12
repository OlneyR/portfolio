<?php
	include ("../../../includes/dbconn.inc.php");
	$conn = dbConnect();
	$t = intval($_GET['t']);
	if ($t == 0 || !$t){$sql2= "SELECT * FROM FGallery order by GID ASC";}
	else {$sql2= "SELECT * FROM FGallery WHERE TID = '".$t."' order by GID ASC";}
	$rs2 = $conn->query($sql2) or die ("Query Failed.");
	while ($row = $rs2->fetch_assoc()){
		print "
			<section class='category-".$row['TID']."'>
				<a href='./images/".$row['image']."'><img src='./images/thumb-".$row['image']."' class='gallimg'></a>
				<div class='gallerytext'>
					<h2>".$row['name']."</h2>
					<p>".$row['text']."</p>
				</div>
				<br class='clear'>
			</section>
		";
	}
	
?>
