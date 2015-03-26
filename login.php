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

#header {
	background: #384E82;
	height: 100%;
	border: 1px solid white;
}

#searchbar {
	padding-bottom: 15px;
}

#login {
	padding: 30px;
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
	
		<center>
		
		<div id="login">
		<form action="login.php" method="post">
			Username: 	<input type="text" name="name"><br><br>
			Password:   <input type="text" name="password"><br><br>
						<input type="submit">
		</form>
		</div>

<?php


$username = $_POST["name"];
$password = $_POST["password"];

if ($username == "" || $password == "") {
	$error = "Please enter your username and/or password!";
	echo $error;
}


?>

	</div></center>
	<div id="right" class="column">&nbsp;</div>

</body>
</html>