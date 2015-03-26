<!DOCTYPE html>
<html>
<style media="screen" type="text/css">

a {
	color: white;
	text-decoration: none;
	padding-right: 10px;
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

#statusbar {
	margin-bottom: 15px;
	color: white;
	background-color: green;
}


#header {
	background: #384E82;
	height: 100%;
	border: 1px solid white;
}

#searchbar {
	padding-bottom: 15px;
}

#login {
	padding: 20px;
	width: 60%;
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
			<div id="nav"><h2><a href="login.php">Login</a> 
							  <a href="account.php">My Account</a>
							  <a href="shoppingcart.php">Shopping Cart</a>
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
	
					$yay = "\r\n Status: connected! \r\n";
					echo nl2br($yay);
					}
					catch (PDOException $Exception){
						$error = "\r\nCould not connect: " . $Exception->getMessage( );
						echo nl2br($error);
					}
				?>
			</div>
			<div id="searchbar">
				<input type="text" name="search" class="search" value=""></input>
				<input type="submit" value="Search"/>
				<input type="submit" value="Advanced Search"/>
			</div>
		</center>
			<div id="navbar" class="column">
				<table id="items" width="100%" cellpadding="7px">
					<tbody align="center">
					<tr><td>Computer Hardware</td></tr>
					<tr><td>Monitors</td></tr>
					<tr><td>Keyboards</td></tr>
					<tr><td>Mice</td></tr>
					<tr><td>Laptops</td></tr>
					<tr><td>Desktop PCs</td></tr>
					<tr><td>Printers</td></tr>
					<tr><td>Networking</td></tr>
					<tr><td>Software</td></tr>
					<tr><td>External Memory</td></tr>
					<tr><td>Sale</td></tr>
					</tbody>
				</table>
			</div>
			<div id="login" class="column">
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
								session_start();
								$_SESSION["user"] = $name;
							} else {
								echo "Wrong password!";	
							}
						}
					}
				?>
				<center><h2>Log In</h2>
					<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
						Username: <input type="text" name="name"><br><br>
						Password: <input type="password" name="password"><br><br>					
						<input type="submit" name="submit" value="Log In"> <br><br>
						<span class="error"> <?php echo $err;?></span>
					</form>
				</center>
			</div>
	</div>
	<div id="right" class="column">&nbsp;</div>
	</div>

</body>
</html>