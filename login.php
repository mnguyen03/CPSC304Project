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

#login {
	width: 60%;
	padding-left: 20%;
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
			<div id="login" class="column"><center>
				<?php
				
					$err = "";
					$name = $pass = "";

					if ($_SERVER["REQUEST_METHOD"] == "POST") {
					   if ((empty($_POST["name"])) || (empty($_POST["password"]))) {
						 $err = "Please enter a username or password!";
					   } else {
						 $name = test_input($_POST["name"]);
						 $pass = test_input($_POST["password"]);
						 login($name, $pass, $pdo);
					   }
					}

					function test_input($data) {
					   $data = trim($data);
					   $data = stripslashes($data);
					   $data = htmlspecialchars($data);
					   return $data;
					}
					
					function login($name, $pass, $pdo) {
						$sql = "SELECT c_pass FROM customer_account WHERE c_name='$name'";
						$statement = $pdo->prepare($sql);
						$statement->execute();
						$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
						if ($rows == null) {
							echo "User does not exist!";
						}
						foreach($rows as $row) {
							if ($pass == $row['c_pass']) {
								$_SESSION["user"] = $name; 
								$_SESSION["admin"] = "false";
							?>
							<?php
							} else {
								echo "Wrong password!";	
							}
						}
					}
				?>
				
				<?php 
				if (!empty($_SESSION)) {
					echo "You are logged in!";
				} else { ?>
				<h2>Log In</h2>
					<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
						Username: <input type="text" name="name"><br><br>
						Password: <input type="password" name="password"><br><br>					
						<input type="submit" name="submit" value="Log In"> <br><br>
						<span class="error"><?php echo $err;?></span>
					</form>
				<?php } ?>
				</center>
			</div>
	</div>
	<div id="right" class="column">&nbsp;</div>
	</div>

</body>
</html>