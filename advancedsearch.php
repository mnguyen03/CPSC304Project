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

#search {
	width: 100%;
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

table#advsearch {
	padding: 15px;
	font-family: Verdana;
	align: middle;
	font-size: 15px;
	border-collapse: collapse;
}

table#advsearch tr:nth-child(even) {
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
			<div id="header">
				<h1><a class="header" href="computerstore.php">H.T.M.L. Computer Store</a></h1>
			</div>
			
			<div id="nav">
				<h2><a href="login.php">Login</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;My Account&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Shopping Cart</h2>
			</div>
			
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
				?>		
			</div>
			
		<div id ="search">
		<form action="advancedsearch.php" method="post">
		<center>	
			<table id="advsearch" width="70%" cellpadding="5px" border="1px">
				<tr>
					<td><center>Product Type</center></td>
					<td><center>Manufacturer</center></td>
					<td><center>Price</center></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="type[]" value="Processor">Processors</input><br>
						<input type="checkbox" name="type[]" value="Motherboard">Motherboards</input><br>
						<input type="checkbox" name="type[]" value="Video Card">Video Cards</input><br>
						<input type="checkbox" name="type[]" value="Power Supply">Power Supplies</input><br>
						<input type="checkbox" name="type[]" value="SSD">SSD</input><br>
						<input type="checkbox" name="type[]" value="Mouse">Mice</input><br>
						<input type="checkbox" name="type[]" value="Headset">Headsets</input><br><br>
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
						<input type="radio" name="price" value="AVG">Average Price</input><br>
						<input type="radio" name="price" value="MAX">MAX</input><br>
						<input type="radio" name="price" value="MIN">MIN</input><br>
						<input type="radio" name="price" value="COUNT">Number of Products</input><br>
					</td>
				<tr>
					<td colspan="3"><center>
						<input type="search" name="search" class="search"></input>
						<input type="submit"></input>
						</center>
					</td>
				<tr>
			</table>
		</center>
		</div>
		<?php	
			if(!empty($_POST['type'])){
				foreach($_POST['type'] as $selected){
					if(isset($_POST['price']) && $_POST['price'] == 'AVG') {
						$sql = "SELECT s_name, s_type, AVG(s_price) FROM supplies_item
								WHERE s_type LIKE ? GROUP BY s_name";
						$statement = $pdo->prepare($sql);
						$statement->execute(array('%'.$selected.'%'));
						$rows = $statement->fetchAll(PDO::FETCH_ASSOC);	
						foreach($rows as $row){
							echo nl2br("\r\n".' '.$row['s_name'].' '.$row['s_type'].', Avg Price: $'.$row['AVG(s_price)']);
						}
					}
					if(isset($_POST['price']) && $_POST['price'] == 'MAX') {
						$sql = "SELECT s_name, s_type, MAX(s_price) FROM supplies_item
								WHERE s_type LIKE ? GROUP BY s_name";
						$statement = $pdo->prepare($sql);
						$statement->execute(array('%'.$selected.'%'));
						$rows = $statement->fetchAll(PDO::FETCH_ASSOC);	
						foreach($rows as $row){
							echo nl2br("\r\n".' '.$row['s_name'].' '.$row['s_type'].', Max Price: $'.$row['MAX(s_price)']);
						}
					}
					if(isset($_POST['price']) && $_POST['price'] == 'MIN') {
						$sql = "SELECT s_name, s_type, MIN(s_price) FROM supplies_item
								WHERE s_type LIKE ? GROUP BY s_name";
						$statement = $pdo->prepare($sql);
						$statement->execute(array('%'.$selected.'%'));
						$rows = $statement->fetchAll(PDO::FETCH_ASSOC);	
						foreach($rows as $row){
							echo nl2br("\r\n".' '.$row['s_name'].' '.$row['s_type'].', Min Price: $'.$row['MIN(s_price)']);
						}
					}
					if(isset($_POST['price']) && $_POST['price'] == 'COUNT') {
						$sql = "SELECT s_name, s_pname, s_type, COUNT(s_pname) FROM supplies_item
								WHERE s_type LIKE ?";
						$statement = $pdo->prepare($sql);
						$statement->execute(array('%'.$selected.'%'));
						$rows = $statement->fetchAll(PDO::FETCH_ASSOC);	
						foreach($rows as $row){
							echo nl2br("\r\n".' '.$row['s_type'].', Count: '.$row['COUNT(s_pname)']);
						}
					}
				}
				echo "<br />";
			}
			/*
			if (isset($_POST['type']) && $_POST['type'] == 'Processor'){
				$sql = "SELECT s_name, s_pname, s_type, s_price FROM supplies_item
						WHERE s_type LIKE 'Processor' ORDER BY s_name";
				$statement = $pdo->prepare($sql);
				$statement->execute(array('%'.$_POST['type'].'%'));
				$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
				foreach($rows as $row){
					echo nl2br("\r\n".' '.$row['s_name'].' '.$row['s_pname'].' '.$row['s_type'].', Price: $'.$row['s_price']);
				}
				echo "<br />";
			}
			*/
			/*
			$types = $_POST['type'];
			if(empty($types)){
				echo "No Product Type selected.";
			} else {
				$N = count($types);
				for($i=0; $i<$N; $i++){
				}
			}
			*/		
			
			
		?>
	
		
		<div id="right" class="column">&nbsp;</div>
</body>
</html>