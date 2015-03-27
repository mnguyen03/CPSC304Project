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

#display {
	width: 75%;
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

input#nonorderitems {
 	border: 0px;
	background: white;
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

table#tdisplay {
	border-collapse: collapse;
}

table#tdisplay tr:nth-child(even) {
	background: #051C50;
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
			<div id="header"><h1><table cellpadding=10px>
									<tr>
										<td><a href="computerstore.php">
												H.<font size=5px>ugo</font><br>
												T.<font size=5px>revor</font><br>
												M.<font size=5px>ichelle</font><br>
												L.<font size=5px>iJye</font><br>
											</a>
										</td>
										<td><a href="computerstore.php">
												Computer Store
											</a>
										</td>
									</tr>
								</table>
							</h1>
			</div>
			<div id="nav"><h2><a href="login.php">Login</a> | 
							  <a href="account.php">My Account</a> |
							  <a href="shoppingcart.php">Shopping Cart</a> |
							  <a href="admin.php">Admin</a> |
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
	
	if ($_SESSION["admin"] !== "true") {
		redirect("adminlogin.php");
	}
	
	function redirect($url, $statusCode = 303) {
		header('Location: ' . $url, true, $statusCode);
		die();
	}
	
	
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
				<input type="text" name="search" class="search" value=""></input>
				<input type="submit" value="Search"/>
				</form>
				<form action="advancedsearch.php">
					<button>Advanced Search</button>
				</form>
			</div>
		</center>
			<div id="navbar" class="column">
				<table id="items" width="100%" cellpadding="7px">
					<tbody align="center">
					<tr>
						<td>
							<form name="acc_search" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
							<input id="evenbtn" type="submit" name="c_accs_button" value="Customer Accounts">
							</form>
						</td>
					</tr>
					<tr>
						<td>
							<form name="order_search" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
							<input id="orderbtn" type="submit" name="c_orders_button" value="Customer Orders">
							</form>
						</td>
					</tr>
					<tr><td>Suppliers</td></tr>
					<tr><td>Stock</td></tr>
					<tr><td>Price Changes</td></tr>
					<tr><td>Sale</td></tr>
					<tr>
 						<td>
 							<form name="no_order_items" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
 							<input id="nonorderitems" type="submit" name="non_order_item_button" value="Customers With No Orders">
 							</form>
 						</td>
 					</tr>
					</tbody>
				</table>
			</div>
			<div id="display" class="column">
			 <?php
				if (!empty($_POST['c_accs_button'])) {
					$sql = "SELECT c_id, c_name, c_email, c_phone FROM customer_account";
					$statement = $pdo->prepare($sql);
					$statement->execute();
					$rows = $statement->fetchALL(PDO::FETCH_ASSOC); 
					}
					
				elseif (!empty($_POST['non_order_item_button'])){
 					$sql = "SELECT C1.c_id, C1.c_name
							FROM Customer_Account C1
							WHERE NOT EXISTS
								(SELECT *
								FROM PurchaseHistory_Contains_Purchase P
								WHERE EXISTS
									(SELECT * 
									FROM Customer_Account C2
									WHERE (C1.c_id = C2.c_id)
									AND (C2.c_id = P.c_id)))";
 					
 					$statement = $pdo->prepare($sql);
 					$statement->execute();
 					$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
 					echo $_POST['non_order_item_button'];
					echo count ($rows);
 					}

				if (!empty($_POST['c_orders_button'])) {
					$sql = "SELECT customer_account.c_id, customer_account.c_name, purchasehistory_contains_purchase.tid
							FROM customer_account 
							JOIN purchasehistory_contains_purchase
							USING (c_id)
							JOIN purchase 
							USING (tid)
							ORDER BY c_id";
					$statement = $pdo->prepare($sql);
					$statement->execute();
					$rows = $statement->fetchALL(PDO::FETCH_ASSOC); 
					}
			 
					if (!empty($_POST['non_order_item_button'])){
						if (!empty($rows)) { 
						 ?>
							<table id="tdisplay" border="1px" width="100%" cellpadding="4px">
							<tbody align="center">
						<tr>
							<th>Customer ID</th>
							<th>Customer Name</th>
						<tr>
				<?php	foreach($rows as $row): ?>
						<tr><center>
							<td><?php echo $row['c_name']?></td>
							<td><?php echo $row['c_id']?></td>
						</tr>
			<?php endforeach; }} ?>
						</tbody>
						</table>
						
			<?php if (!empty($_POST['c_accs_button'])) {
						if (!empty($rows)) { ?>
					<table id="tdisplay" border="1px" width="100%" cellpadding="4px">
					<tbody align="center">
						<tr>
							<th>Customer ID</th>
							<th>Customer Name</th>
							<th>Email</th>
							<th>Phone</th>
						<tr>
				<?php	foreach($rows as $row): ?>
						<tr>
							<td><?php echo $row['c_id']?></td>
							<td><?php echo $row['c_name']?></td>
							<td><?php echo $row['c_email']?></td>
							<td><?php echo $row['c_phone']?></td>
						</tr>
			<?php endforeach; }} ?>
			</tbody>
			</table>
			<?php if (!empty($_POST['c_orders_button'])) {
			if (!empty($rows)) { ?>
					<table id="tdisplay" border="1px" width="100%" cellpadding="4px">
					<tbody align="center">
						<tr>
							<th>Customer ID</th>
							<th>Customer Name</th>
							<th>Transaction ID</th>
						<tr>
				<?php	foreach($rows as $row): ?>
						<tr>
							<td><?php echo $row['c_id']?></td>
							<td><?php echo $row['c_name']?></td>
							<td><?php echo $row['tid']?></td>
						</tr>
			<?php endforeach; }} ?>
					</tbody>
					</table>
					&nbsp;
			</div>
	</div>
	<div id="right" class="column">&nbsp;</div>

</body>
</html>