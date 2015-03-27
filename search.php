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

.search{
	width: 450px;
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

</style>
	<body>
	<div id="wrapper">
	<div id="left" class="column">&nbsp;</div>
	<div id="middle" class="column">
		<center>
			<div id="header"><h1><a class="header" href="computerstore.php">H.T.M.L. Computer Store</a></h1></div>
			<div id="nav"><h2><a href="login.php">Login</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;My Account&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Shopping Cart</h2></div>
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
				<table id="attributes" width="70%" cellpadding="5px" border="1px">
				<tr>
					<td>Select Attributes to Display:</td>
				</tr>
				<tr>
					<td>
						<input type="checkbox" name="prodattribute[]" value="s_name">Supplier Name</input><br>
						<input type="checkbox" name="prodattribute[]" value="s_pname">Product Name</input><br>
						<input type="checkbox" name="prodattribute[]" value="s_pid">Product ID</input>
					</td>
					<td>
						<input type="checkbox" name="prodattribute[]" value="s_stock">Stock</input><br>
						<input type="checkbox" name="prodattribute[]" value="s_type">Product Type</input><br>
						<input type="checkbox" name="prodattribute[]" value="s_price">Price</input>
					</td>
				</tr>
				
				<input type="submit" value="Search"/>
				</form>
				<form action="advancedsearch.php">
					<button>Advanced Search</button>
				</form>
			</div>
		</center>
		<center>

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
	$yay = "\r\n Hooray, we connected to MySQL \r\n";
	echo nl2br($yay);
	}
	catch (PDOException $Exception){
		$error = "\r\nCould not connect: " . $Exception->getMessage( );
		echo nl2br($error);
	}
	$sql = "SELECT * FROM supplies_item 
			WHERE s_pname LIKE ? AND 
			s_type LIKE ? ORDER BY s_type";
	$statement = $pdo->prepare($sql);
	$checked_count = 0;
	if (isset($_POST['prodattribute'])){
		$checked_count = count($_POST['prodattribute']);
	}
	echo "\r\n You have selected ".$checked_count." option(s). \r\n";
	$item_types = array("%", "Case", "Headset", "Monitor", "Motherboard", "Mouse",
							"Power Supply", "Processor", "RAM", "SSD", "Video Card");
	if (strcmp($_POST['search'], "") == 0){
		$statement->execute(array('%', $item_types[$_POST['itemType']]));
		$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	else{
		$statement->execute(array('%'.$_POST['search'].'%', $item_types[$_POST['itemType']]));
		$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	
	if (!isset($_POST['prodattribute'])):
	echo "\r\n No attributes selected to display. Displaying all attributes. \r\n"
	
	?>
	<table>
			<tr>

				<th>Supplier Name</th>
				<th>Product Name</th>
				<th>Product ID</th>
				<th>Current Stock</th>
				<th>Product Type</th>
				<th>Price</th>
			<tr>
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
	
	<?php else: ?>
		<table>
			<tr>
				<?php if (in_array("s_name", $_POST['prodattribute'])): ?>
				<th>Supplier Name</th>
				<?php endif; 
					if (in_array("s_pname", $_POST['prodattribute'])): ?>
				<th>Product Name</th>
				<?php endif; 
					if (in_array("s_pid", $_POST['prodattribute'])): ?>
				<th>Product ID</th>
				<?php endif; 
					if (in_array("s_stock", $_POST['prodattribute'])): ?>
				<th>Current Stock</th>
				<?php endif; 
					if (in_array("s_type", $_POST['prodattribute'])): ?>
				<th>Product Type</th>
				<?php endif; 
					if (in_array("s_price", $_POST['prodattribute'])): ?>
				<th>Price</th>
				<?php endif; ?>
			<tr>
			<?php foreach($rows as $row): ?>
			
			<tr>
				<?php if (in_array("s_name", $_POST['prodattribute'])): ?>
				<td><?php echo $row['s_name']?></td>
				<?php endif;
					if (in_array("s_pname", $_POST['prodattribute'])): ?>
				<td><?php echo $row['s_pname']?></td>
				<?php endif;
					if (in_array("s_pid", $_POST['prodattribute'])): ?>
				<td><?php echo $row['s_pid']?></td>
				<?php endif;
					if (in_array("s_stock", $_POST['prodattribute'])): ?>
				<td><?php echo $row['s_stock']?></td>
				<?php endif;
					if (in_array("s_type", $_POST['prodattribute'])): ?>
				<td><?php echo $row['s_type']?></td>
				<?php endif;
					if (in_array("s_price", $_POST['prodattribute'])): ?>
				<td><?php echo $row['s_price']?></td>
				<?php endif; ?>
			</tr>

	<?php endforeach; ?>
		</table>
	<?php
	endif;
	echo "<br />";
?>


	</div></center>
	<div id="right" class="column">&nbsp;</div>

</body>
</html>
