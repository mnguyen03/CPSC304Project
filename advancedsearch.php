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

#display {
	width: 60%;
	padding-top: 7%;
	padding-left: 7%;
}

#header {
	background: #384E82;
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
	width: 350px;
}

input#logoutbtn {
	border: 0px;
	color: white;
	background: #051C50;
	font-family: "Century Gothic";
	font-size: 15px;
	font-variant: small-caps;
}

input#evenbtn {
	border: 0px;
	background: white;
	font-family: Verdana;
	font-size: 15px;
}

input#oddbtn {
	border: 0px;
	background: #384E82;
	color: white;
	font-family: Verdana;
	font-size: 15px;
}

h1 {
	color: white; 
	font-size: 50px;
	font-weight: bold; 
	font-variant: small-caps;
	font-family: Arial Black;
	line-height: 45px; 
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
	margin-bottom: 10px;
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
			<a href="computerstore.php">
				<IMG SRC="304Matrix.jpg" alt="Make sure you put 304Matrix.jpg in the correct folder" width =100% height="360"/>
			</a>
			<div id="nav"><h2><a href="login.php">Login</a> | 
							  <a href="account.php">My Account</a> |
							  <a href="shoppingcart.php">Shopping Cart</a> |
							  <?php
								if ((!empty($_SESSION)) && ($_SESSION['admin'] = "true")) { ?>
							  	  <a href="admin.php">Admin</a> | 
								<?php } else { ?>
								  <a href="adminlogin.php">Admin</a> |
								<?php }	?>
								  
							<form action="logout.php"><input id="logoutbtn" type="submit" value="Log Out"></input></form>
						  </h2>
			</div>
			<div id="statusbar">
				<?php
					try{
						if(!$pdo = new PDO('mysql:host=localhost;dbname=computerstoredb',
						'root',
						'admin1')
						){
					$sad = "\r\n :( \r\n";
					echo nl2br($sad);
					exit;
					}
	
	$yay = "\r\n Status: Connected to Database! \r\n";
	echo $yay;
	}
	catch (PDOException $Exception){
		$error = "\r\nCould not connect: " . $Exception->getMessage( );
		echo nl2br($error);
	}
	
	session_start();
	
	if (!empty($_SESSION["user"])) {
		echo "<br />" . "Welcome " . $_SESSION["user"];
	} else {
		echo "<br />" . "Currently not logged in.";
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
					<div id="searchbar">
				<form action="search.php" method="post">
				<select name="itemType">
					<option value="0">Select an item type</option>
					<option value="1">Case</option>
					<option value="2">Headset</option>
					<option value="3">Monitor</option>
					<option value="4">Motherboard</option>
					<option value="5">Mouse</option>
					<option value="6">Power Supply</option>
					<option value="7">Processor</option>
					<option value="8">RAM</option>
					<option value="9">SSD</option>
					<option value="10">Video Card</option>
				</select>
				<input type="text" name="search" class="search" value="" placeholder="Search for Product Name..."></input>
				<input type="submit" value="Search"/>
				</form>
				<form action="advancedsearch.php">
					<button>Advanced Search</button>
				</form>
			</div>
			
		<div id ="search">
		<form action="advancedsearch.php" method="post">
		<center>	
			<table id="advsearch" width="70%" cellpadding="5px" border="1px">
				<tr>
					<td><center>Product Type</center></td>
					<td><center>Display</center></td>
					<td><center>Details</center></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="type[]" value="Processor">Processors</input><br>
						<input type="checkbox" name="type[]" value="Motherboard">Motherboards</input><br>
						<input type="checkbox" name="type[]" value="Video Card">Video Cards</input><br>
						<input type="checkbox" name="type[]" value="Power Supply">Power Supplies</input><br>
						<input type="checkbox" name="type[]" value="SSD">SSD</input><br>
						<input type="checkbox" name="type[]" value="Mouse">Mice</input><br>
						<input type="checkbox" name="type[]" value="Headset">Headsets</input><br>
						<input type="checkbox" name="type[]" value="Case">Cases</input><br><br>
					</td>
					<td>
						<input type="radio" name="group" value="1">Show Each Supplier</input><br>
						<input type="radio" name="group" value="2">Show Maximum Of</input><br>
						<input type="radio" name="group" value="3">Show Minimum Of</input><br>
					</td>
					<td>
						<input type="radio" name="price" value="AVG">Average Price</input><br>
						<input type="radio" name="price" value="MAX">Highest Price</input><br>
						<input type="radio" name="price" value="MIN">Lowest Price</input><br>
						<input type="radio" name="price" value="COUNT" required>Number of Products</input><br>
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
					if(isset($_POST['group']) && $_POST['group'] == 1){
						if(isset($_POST['price']) && $_POST['price'] == 'AVG'):
							$sql = "SELECT s_name, s_type, AVG(s_price) FROM supplies_item
									WHERE s_type LIKE ? GROUP BY s_name";
							$statement = $pdo->prepare($sql);
							$statement->execute(array('%'.$selected.'%'));
							$rows = $statement->fetchAll(PDO::FETCH_ASSOC);	?>
							<table>
								<tr>
									<th>Supplier Name</th>
									<th>Product Type</th>
									<th>Average Price</th>
								</tr>
								<?php foreach($rows as $row): ?>
			
								<tr>
									<td><?php echo $row['s_name']?></td>
									<td><?php echo $row['s_type']?></td>
									<td><?php echo $row['AVG(s_price)']?></td>
								</tr>
								<?php endforeach; ?>
							</table>
						<?php endif;

						if(isset($_POST['price']) && $_POST['price'] == 'MAX'):
							$sql = "SELECT s_name, s_type, MAX(s_price) FROM supplies_item
									WHERE s_type LIKE ? GROUP BY s_name";
							$statement = $pdo->prepare($sql);
							$statement->execute(array('%'.$selected.'%'));
							$rows = $statement->fetchAll(PDO::FETCH_ASSOC);	?>
							<table>
								<tr>
									<th>Supplier Name</th>
									<th>Product Type</th>
									<th>Highest Price</th>
								</tr>
								<?php foreach($rows as $row): ?>
			
								<tr>
									<td><?php echo $row['s_name']?></td>
									<td><?php echo $row['s_type']?></td>
									<td><?php echo $row['MAX(s_price)']?></td>
								</tr>
								<?php endforeach; ?>
							</table>
						<?php endif;
						
						if(isset($_POST['price']) && $_POST['price'] == 'MIN'):
							$sql = "SELECT s_name, s_type, MIN(s_price) FROM supplies_item
									WHERE s_type LIKE ? GROUP BY s_name";
							$statement = $pdo->prepare($sql);
							$statement->execute(array('%'.$selected.'%'));
							$rows = $statement->fetchAll(PDO::FETCH_ASSOC);	?>
							<table>
								<tr>
									<th>Supplier Name</th>
									<th>Product Type</th>
									<th>Lowest Price</th>
								</tr>
								<?php foreach($rows as $row): ?>
			
								<tr>
									<td><?php echo $row['s_name']?></td>
									<td><?php echo $row['s_type']?></td>
									<td><?php echo $row['MIN(s_price)']?></td>
								</tr>
								<?php endforeach; ?>
							</table>
						<?php endif;
						
						if(isset($_POST['price']) && $_POST['price'] == 'COUNT'):
							$sql = "SELECT s_name, s_pname, s_type, COUNT(s_pname) FROM supplies_item
									WHERE s_type LIKE ? GROUP BY s_name";
							$statement = $pdo->prepare($sql);
							$statement->execute(array('%'.$selected.'%'));
							$rows = $statement->fetchAll(PDO::FETCH_ASSOC);	?>
							<table>
								<tr>
									<th>Supplier Name</th>
									<th>Product Type</th>
									<th>Quantity</th>
								</tr>
								<?php foreach($rows as $row): ?>
			
								<tr>
									<td><?php echo $row['s_name']?></td>
									<td><?php echo $row['s_type']?></td>
									<td><?php echo $row['COUNT(s_pname)']?></td>
								</tr>
								<?php endforeach; ?>
							</table>
						<?php endif;
						
					} else if(isset($_POST['group']) && $_POST['group'] == 2){
						if(isset($_POST['price']) && $_POST['price'] == 'AVG'):
							$sql = "SELECT s_type, MAX(avg_price)
									FROM (SELECT s_name, s_type, AVG(s_price) AS avg_price
											FROM supplies_item
											WHERE s_type LIKE ?
											GROUP BY s_name) AS supplies_item";
							$statement = $pdo->prepare($sql);
							$statement->execute(array('%'.$selected.'%'));
							$rows = $statement->fetchAll(PDO::FETCH_ASSOC);	?>
							<table>
								<tr>
									<th>Product Type</th>
									<th>Max of Average Prices</th>
								</tr>
								<?php foreach($rows as $row): ?>
			
								<tr>
									<td><?php echo $row['s_type']?></td>
									<td><?php echo $row['MAX(avg_price)']?></td>
								</tr>
								<?php endforeach; ?>
							</table>
						<?php endif;

						if(isset($_POST['price']) && $_POST['price'] == 'MAX'):
							$sql = "SELECT s_type, MAX(max_price)
									FROM (SELECT s_name, s_type, MAX(s_price) AS max_price
											FROM supplies_item
											WHERE s_type LIKE ?
											GROUP BY s_name) AS supplies_item";
							$statement = $pdo->prepare($sql);
							$statement->execute(array('%'.$selected.'%'));
							$rows = $statement->fetchAll(PDO::FETCH_ASSOC);	?>
							<table>
								<tr>
									<th>Product Type</th>
									<th>Max of Highest Prices</th>
								</tr>
								<?php foreach($rows as $row): ?>
			
								<tr>
									<td><?php echo $row['s_type']?></td>
									<td><?php echo $row['MAX(max_price)']?></td>
								</tr>
								<?php endforeach; ?>
							</table>
						<?php endif;
						
						if(isset($_POST['price']) && $_POST['price'] == 'MIN'):
							$sql = "SELECT s_type, MAX(min_price)
									FROM (SELECT s_name, s_type, MIN(s_price) AS min_price
											FROM supplies_item
											WHERE s_type LIKE ?
											GROUP BY s_name) AS supplies_item";
							$statement = $pdo->prepare($sql);
							$statement->execute(array('%'.$selected.'%'));
							$rows = $statement->fetchAll(PDO::FETCH_ASSOC);	?>
							<table>
								<tr>
									<th>Product Type</th>
									<th>Max of Lowest Prices</th>
								</tr>
								<?php foreach($rows as $row): ?>
			
								<tr>
									<td><?php echo $row['s_type']?></td>
									<td><?php echo $row['MAX(min_price)']?></td>
								</tr>
								<?php endforeach; ?>
							</table>
						<?php endif;
						
						if(isset($_POST['price']) && $_POST['price'] == 'COUNT'):
							$sql = "SELECT s_type, MAX(counts)
									FROM (SELECT s_name, s_type, COUNT(s_pname) AS counts
											FROM supplies_item
											WHERE s_type LIKE ?
											GROUP BY s_name) AS supplies_item";
							$statement = $pdo->prepare($sql);
							$statement->execute(array('%'.$selected.'%'));
							$rows = $statement->fetchAll(PDO::FETCH_ASSOC);	?>
							<table>
								<tr>
									<th>Product Type</th>
									<th>Highest Quantity</th>
								</tr>
								<?php foreach($rows as $row): ?>
			
								<tr>
									<td><?php echo $row['s_type']?></td>
									<td><?php echo $row['MAX(counts)']?></td>
								</tr>
								<?php endforeach; ?>
							</table>
						<?php endif;
					} else if(isset($_POST['group']) && $_POST['group'] == 3){
						if(isset($_POST['price']) && $_POST['price'] == 'AVG'):
							$sql = "SELECT s_type, MIN(avg_price)
									FROM (SELECT s_name, s_type, AVG(s_price) AS avg_price
											FROM supplies_item
											WHERE s_type LIKE ?
											GROUP BY s_name) AS supplies_item";
							$statement = $pdo->prepare($sql);
							$statement->execute(array('%'.$selected.'%'));
							$rows = $statement->fetchAll(PDO::FETCH_ASSOC);	?>
							<table>
								<tr>
									<th>Product Type</th>
									<th>Min of Average Prices</th>
								</tr>
								<?php foreach($rows as $row): ?>
			
								<tr>
									<td><?php echo $row['s_type']?></td>
									<td><?php echo $row['MIN(avg_price)']?></td>
								</tr>
								<?php endforeach; ?>
							</table>
						<?php endif;

						if(isset($_POST['price']) && $_POST['price'] == 'MAX'):
							$sql = "SELECT s_type, MIN(max_price)
									FROM (SELECT s_name, s_type, MAX(s_price) AS max_price
											FROM supplies_item
											WHERE s_type LIKE ?
											GROUP BY s_name) AS supplies_item";
							$statement = $pdo->prepare($sql);
							$statement->execute(array('%'.$selected.'%'));
							$rows = $statement->fetchAll(PDO::FETCH_ASSOC);	?>
							<table>
								<tr>
									<th>Product Type</th>
									<th>Min of Highest Prices</th>
								</tr>
								<?php foreach($rows as $row): ?>
			
								<tr>
									<td><?php echo $row['s_type']?></td>
									<td><?php echo $row['MIN(max_price)']?></td>
								</tr>
								<?php endforeach; ?>
							</table>
						<?php endif;
						
						if(isset($_POST['price']) && $_POST['price'] == 'MIN'):
							$sql = "SELECT s_type, MIN(min_price)
									FROM (SELECT s_name, s_type, MIN(s_price) AS min_price
											FROM supplies_item
											WHERE s_type LIKE ?
											GROUP BY s_name) AS supplies_item";
							$statement = $pdo->prepare($sql);
							$statement->execute(array('%'.$selected.'%'));
							$rows = $statement->fetchAll(PDO::FETCH_ASSOC);	?>
							<table>
								<tr>
									<th>Product Type</th>
									<th>Min of Lowest Prices</th>
								</tr>
								<?php foreach($rows as $row): ?>
			
								<tr>
									<td><?php echo $row['s_type']?></td>
									<td><?php echo $row['MIN(min_price)']?></td>
								</tr>
								<?php endforeach; ?>
							</table>
						<?php endif;
						
						if(isset($_POST['price']) && $_POST['price'] == 'COUNT'):
							$sql = "SELECT s_type, MIN(counts)
									FROM (SELECT s_name, s_type, COUNT(s_pname) AS counts
											FROM supplies_item
											WHERE s_type LIKE ?
											GROUP BY s_name) AS supplies_item";
							$statement = $pdo->prepare($sql);
							$statement->execute(array('%'.$selected.'%'));
							$rows = $statement->fetchAll(PDO::FETCH_ASSOC);	?>
							<table>
								<tr>
									<th>Product Type</th>
									<th>Lowest Quantity</th>
								</tr>
								<?php foreach($rows as $row): ?>
			
								<tr>
									<td><?php echo $row['s_type']?></td>
									<td><?php echo $row['MIN(counts)']?></td>
								</tr>
								<?php endforeach; ?>
							</table>
						<?php endif;
					} else {
						if(isset($_POST['price']) && $_POST['price'] == 'AVG'):
							$sql = "SELECT s_type, AVG(s_price) FROM supplies_item
									WHERE s_type LIKE ?";
							$statement = $pdo->prepare($sql);
							$statement->execute(array('%'.$selected.'%'));
							$rows = $statement->fetchAll(PDO::FETCH_ASSOC);	?>
							<table>
								<tr>
									<th>Product Type</th>
									<th>Average Price</th>
								</tr>
								<?php foreach($rows as $row): ?>
			
								<tr>
									<td><?php echo $row['s_type']?></td>
									<td><?php echo $row['AVG(s_price)']?></td>
								</tr>
								<?php endforeach; ?>
							</table>
						<?php endif;
						
						if(isset($_POST['price']) && $_POST['price'] == 'MAX'):
							$sql = "SELECT s_type, MAX(s_price) FROM supplies_item
									WHERE s_type LIKE ?";
							$statement = $pdo->prepare($sql);
							$statement->execute(array('%'.$selected.'%'));
							$rows = $statement->fetchAll(PDO::FETCH_ASSOC);	?>
							<table>
								<tr>
									<th>Product Type</th>
									<th>Highest Price</th>
								</tr>
								<?php foreach($rows as $row): ?>
			
								<tr>
									<td><?php echo $row['s_type']?></td>
									<td><?php echo $row['MAX(s_price)']?></td>
								</tr>
								<?php endforeach; ?>
							</table>
						<?php endif;
						
						if(isset($_POST['price']) && $_POST['price'] == 'MIN'):
							$sql = "SELECT s_type, MIN(s_price) FROM supplies_item
									WHERE s_type LIKE ?";
							$statement = $pdo->prepare($sql);
							$statement->execute(array('%'.$selected.'%'));
							$rows = $statement->fetchAll(PDO::FETCH_ASSOC);	?>
							<table>
								<tr>
									<th>Product Type</th>
									<th>Lowest Price</th>
								</tr>
								<?php foreach($rows as $row): ?>
			
								<tr>
									<td><?php echo $row['s_type']?></td>
									<td><?php echo $row['MIN(s_price)']?></td>
								</tr>
								<?php endforeach; ?>
							</table>
						<?php endif;
						
						if(isset($_POST['price']) && $_POST['price'] == 'COUNT'):
							$sql = "SELECT s_pname, s_type, COUNT(s_pname) FROM supplies_item
									WHERE s_type LIKE ?";
							$statement = $pdo->prepare($sql);
							$statement->execute(array('%'.$selected.'%'));
							$rows = $statement->fetchAll(PDO::FETCH_ASSOC);	?>
							<table>
								<tr>
									<th>Product Type</th>
									<th>Quantity</th>
								</tr>
								<?php foreach($rows as $row): ?>
			
								<tr>
									<td><?php echo $row['s_type']?></td>
									<td><?php echo $row['COUNT(s_pname)']?></td>
								</tr>
								<?php endforeach; ?>
							</table>
						<?php endif;
					}
				}
				echo "<br />";
			} else {
				$sql = "SELECT *
						FROM supplies_item";
				$statement = $pdo->prepare($sql);
				$statement->execute(array($sql));
				$rows = $statement->fetchAll(PDO::FETCH_ASSOC); ?>
				<table>
					<tr>
						<th>Supplier Name</th>
						<th>Product Name</th>
						<th>Product ID</th>
						<th>Current Stock</th>
						<th>Product Type</th>
						<th>Price</th>
					</tr>
					<?php foreach($rows as $row): ?>
			
					<tr>
						<td><?php echo $row['s_name']?></td>
						<td><?php echo $row['s_pname']?></td>
						<td><?php echo $row['s_pid']?></td>
						<td><?php echo $row['s_stock']?></td>
						<td><?php echo $row['s_type']?></td>
						<td><?php echo $row['s_price']?></td>
					</tr>
					<?php endforeach; ?>
				</table>
			<?php }?>
		<div id="right" class="column">&nbsp;</div>
		
		
</body>
</html>