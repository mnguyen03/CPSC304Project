<!DOCTYPE html>
<html>
<style media="screen" type="text/css">

a {
	color: white;
	text-decoration: none;
}

#wrapper .column {
	position: relative;
	float: left;
}

#left {
	width: 25%;
}

#middle {
	width: 50%;
}

#right {
	width: 25%;
}

#navbar {
	width: 25%;
}

#header {
	background: #384E82;
	height: 100%;
	border: 1px solid white;
}

#searchbar {
	padding-bottom: 15px;
}

#statusbar {
	margin-bottom: 15px;
	color: white;
	background-color: green;
}

.search{
	width: 300px;
}

h1 {
	color: white; 
	font-size: 50px;
	font-weight: bold; 
	font-variant: small-caps;
	font-family: Arial Black;
	line-height: 50px; 
	padding-top: 2px; 
	padding-bottom: 5px;
}

h2 {
	color: white;
	font-family: "Century Gothic"; 
	font-weight: normal; 
	font-size: 15px; 
	background: #051C50; 
	font-variant: small-caps; 
	padding: 5px;
}

table#items {
	padding: 15px;
	font-family: Verdana;
	align: middle;
	font-size: 15px;
}

table#items tr:nth-child(even) {
	background: #384E82;
	color: white;
}

form {
	display: inline;
}

</style>
	<body>
	<div id="wrapper">
	<div id="left" class="column">&nbsp;</div>
	<div id="middle" class="column">
		<center>
			<div id="header"><h1><a class="header" href="computerstore.php">H.T.M.L. Computer Store</a></h1></div>
			<div id="nav"><h2><a href="login.php">Login</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;My Account&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Shopping Cart</h2></div>
			<div id="statusbar">
				<?php
					$title = "SQL Query Test";
					echo nl2br($title);
					try{
						if(!$pdo = new PDO('mysql:host=localhost;dbname=computerstoredb',
						'root',
						'admin1')
						){
					$sad = "\r\n :( \r\n";
					echo nl2br($sad);
					exit;
					}
	
	$yay = "\r\n Hooray, we connected \r\n";
	echo nl2br($yay);
	}
	catch (PDOException $Exception){
		$error = "\r\nCould not connect: " . $Exception->getMessage( );
		echo nl2br($error);
	}
	
/* 	$sql = "SELECT c_name FROM customer_account ORDER BY c_name";
	echo "Customers: <br />";
	foreach ($pdo->query($sql) as $row) {
		echo nl2br($row['c_name']);
		echo "<br />";
	}
	 */
?>		
			</div>

		<center>	
		<table id="advsearch" width="50%" cellpadding="5px" border="1px">
			<tr>
				<td><center>Product Type</center></td>
				<td><center>Manufacturer</center></td>
				<td><center>Price</center></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="prodtype" value="Processor">Processors</input><br>
					<input type="checkbox" name="prodtype" value="Motherboard">Motherboards</input><br>
					<input type="checkbox" name="prodtype" value="Video Card">Video Cards</input><br>
					<input type="checkbox" name="prodtype" value="Power Supply">Power Supplies</input><br>
					<input type="checkbox" name="prodtype" value="SSD">SSD</input><br>
					<input type="checkbox" name="prodtype" value="Mouse">Mice</input><br>
					<input type="checkbox" name="prodtype" value="Headset">Headsets</input><br><br>
				</td>
				<td>
					<input type="checkbox" name="manu" value="AMD">AMD</input><br>
					<input type="checkbox" name="manu" value="ASRock">ASRock</input><br>
					<input type="checkbox" name="manu" value="Asus">Asus</input><br>
					<input type="checkbox" name="manu" value="EVGA">EVGA</input><br>
					<input type="checkbox" name="manu" value="Gigabyte">Gigabyte</input><br>
					<input type="checkbox" name="manu" value="Intel">Intel</input><br>
					<input type="checkbox" name="manu" value="Logitech">Logitech</input><br>
					<input type="checkbox" name="manu" value="MSI">MSI</input><br>
				</td>
				<td>
					<input type="checkbox" name="price" value="50">$0 to $50</input><br>
					<input type="checkbox" name="price" value="100">Up to $100</input><br>
					<input type="checkbox" name="price" value="200">Up to $200</input><br>
					<input type="checkbox" name="price" value="300">Up to $300</input><br>
					<input type="checkbox" name="price" value="1000">All Prices</input><br><br><br>
				</td>
			<tr>
				<td colspan="3"><center>
					<input type="search" name="search" class="search"></input>
					<input type="submit"></input>
					</center>
				</td>
			<tr>
			</center>

	</div></center>
	<div id="right" class="column">&nbsp;</div>
</body>
</html>