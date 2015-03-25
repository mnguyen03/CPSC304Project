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
				<input type="text" name="search" class="search" value=""></input>
				<input type="submit" value="Search"/>
				<input type="submit" value="Advanced Search"/>
				</form>
			</div>
		</center>
		<center>

<?php
   $title = "Search bar input test";
   echo nl2br($title);
   try{
   if(!$pdo = new PDO('mysql:host=localhost;dbname=computerstoredb',
    'root',
    'admin_1')
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
	echo "You searched for: ";
	echo $_POST['search'];
	echo "<br />";
	
?>


	</div></center>
	<div id="right" class="column">&nbsp;</div>

</body>
</html>
