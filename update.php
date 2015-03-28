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
					<tr><td><a href="update.php">Update PIDs</a></td></tr>
					</tbody>
				</table>
			</div>
			<form action="update.php" method="post">
				<div id="searchbar">
					<input type="text" name="updateold" class="search" value="" placeholder="Enter Old PID Value"></input>
					<input type="text" name="updatenew" class="search" value="" placeholder="Enter New PID Value"></input>
					<input type="submit" value="Update"></input>
				</div>
			</form>
		<?php 
			$sql = "SELECT * FROM supplies_item";
			$statement = $pdo->prepare($sql);
			$statement->execute();
			$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
			$pids = array();
			$index = 0;
			foreach($rows as $row){
			$pids[$index] = $row['s_pid'];
			$index = $index + 1;
			}
			
			if ( ( strcmp($_POST['updateold'], "") == 0) or (strcmp($_POST['updatenew'], "") == 0)   ){
			echo "Please make sure you enter a PID in both fields";
			}
			
			//check the old value does exist in the table and new value does not exist in the table
			else{
				$canupdate = True;
				$existsold = False;
				foreach($pids as $pid){
					if($pid == $_POST['updateold']){
						$existsold = True;
						break;
					}
				}
				if(!$existsold){
					echo "Old value does not exist in the table. Please choose an existing value to replace";
					$canupdate = False;
					}
				$existsnew = False;
				foreach ($pids as $pid){
					if ($pid == $_POST['updatenew']){
						$existsnew = True;
						break;
					}
				}
				if ($existsnew){
					echo "New value already exists in the table. Please choose a value that doesn't exist to update";
					$canupdate = False;
				}
			}
			
			
			
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
			<?php foreach($rows as $row):?>
			
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
	<?php
		//$_POST['updateold'] is the value that will be replaced with $_POST['updatenew']
		if ($canupdate){
			echo "setup SQL statement to update the PID value using variables in comments";
			
		}
		
		
		
		