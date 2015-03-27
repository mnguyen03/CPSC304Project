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
	padding-top: 50px;
	padding-left: 100px;
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
		</center>
			<div id="navbar" class="column">
				<table id="items" width="100%" cellpadding="7px">
					<tbody align="center">
					<tr>
						<td>
							<form name="aboutus" method="POST" action="<?php echo $_SERVER["PHP_SELF"]?>">
								<input id="evenbtn" type="submit" name="aboutusbtn" value="About Us">
							</form>
						</td>
					</tr>
					<tr>
						<td>
							<form name="shipping" method="POST" action="<?php echo $_SERVER["PHP_SELF"]?>">
								<input id="oddbtn" type="submit" name="shippingbtn" value="Shipping">
							</form>						
						</td>
					</tr>
					<tr>
						<td>
							<form name="admin" method="POST" action="<?php echo $_SERVER["PHP_SELF"]?>">
								<input id="evenbtn" type="submit" name="adminbtn" value="Administrators">
							</form>						
						</td>
					</tr>
					<tr>
						<td>
							<form name="contact" method="POST" action="<?php echo $_SERVER["PHP_SELF"]?>">
								<input id="oddbtn" type="submit" name="contactbtn" value="Contact Us">
							</form>						
						</td>
					</tr>
					<tr>
						<td>
							<form name="shipping" method="POST" action="<?php echo $_SERVER["PHP_SELF"]?>">
								<input id="evenbtn" type="submit" name="feedbackbtn" value="Feedback">
							</form>						
						</td>
					</tr>
					</tbody>
				</table>
			</div>
		<div id="display" class="column">
			
		<?php 
				if (empty($_POST)) {
					if (!empty($_SESSION['user'])) {
						echo "Welcome to our store!<br />";
						echo 'You are the one, ' . $_SESSION['user'] . '...';
					} else {
						echo "Welcome to our store!<br />";
						echo 'You are the one, guest...';						
					}
				}
				
				if(!empty($_POST['aboutusbtn'])) {
					echo "<b>About Us <br /><br /></b>";
					echo "Totally not sketch to buy from us ;)<br /><br />";
					echo '"10/10" - IGN';
				} 
				
				if(!empty($_POST['shippingbtn'])) {
					echo "test";
				}
				
				if(!empty($_POST['adminbtn'])) {
					echo "<b>Hugo Lee</b><br />";
					echo "(555)-123-4567 ext. 1111<br /><br />";
					echo "<b>Trevor Tuepah</b><br />";
					echo "(555)-123-4567 ext. 2222<br /><br />";
					echo "<b>Michelle Nguyen</b><br />";
					echo "(555)-123-4567 ext. 3333<br /><br />";
					echo "<b>LiJye Tong</b><br />";
					echo "(555)-123-4567 ext. 4444<br /><br />";
					
				}
				
				if(!empty($_POST['contactbtn'])) {
					echo "If you have any questions and/or concerns, <br />";
					echo "please email us at <b>htmlstore@htmlstore.com</b>";
				}
				
				if(!empty($_POST['feedbackbtn'])) {
					?>
					<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
						Name: <input type="text" name="name"><br><br>
						E-mail: <input type="text" name="email"><br><br>
						Comment: <textarea name="comment" rows="5" cols="70"></textarea><br><br>
						<input type="submit" name="submit" value="Submit"> <br><br>
					</form>
					<?php
				}
		?>
		</div>
	</div></center>
	<div id="right" class="column">&nbsp;</div>

</body>
</html>