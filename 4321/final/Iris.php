<?php
include("../../../includes/dbconn.inc.php"); //db connection
include("shared.php");
$conn = dbConnect();


print $PageHeader; 
print $Navigation;
?>
	<div id="opener">
		<h1><strong>
			Arlington, TX Coffee Shop
		</strong></h1>
		<h2>Iris Bagel and Coffee House</h2>
		<p><strong>Come and enjoy fresh bagels in Iris Bagel and Coffee House.</strong> Our family owned and operated coffee shop serves homemade baked goods that are made from scratch. Come and stay for our different kinds of coffee, deli sandwiches, and bagels that you can enjoy with different toppings.</p>
	</div>
	<div id="image1">
		<img src="IrisBagel.jpg" alt="Iris Bagel">
	</div>
	<div id="homeList">
		<p><strong>Learn More About Iris Bagel and Coffee House:</strong></p>
		<ul>
			<li>Espresso - coffee bar</li>
			<li>Coffee on ice</li>
			<li>Blended beverages</li>
			<li>Fresh bagels</li>
			<li>Bagel with topping</li>
			<li>Cream cheese to go</li>
			<li>Breakfast favorites</li>
			<li>Baked goods</li>
			<li>Deli sandwiches</li>
			<li>Special sandwiches</li>
		</ul>
		<p><strong>Call in orders are welcome.</strong></p><br>
	</div>
<?php print $PageFooter; ?>

