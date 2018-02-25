<?php
session_start();
if(!isset($_SESSION['online'])){
	header('Location: ../');
	exit();
}
$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Social-network</title>
	<meta charset="utf-8" />
	<link href="default.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../main.css" rel="stylesheet" type="text/css" media="all" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php
	if($_SERVER['REQUEST_URI'] == '/social-network/panel/relations.php'){
	?>
	<script src="relations.js"></script>
	<?php	
	}
	?>
</head>
<body>
	<div id="error">
		<p id="statement"><?php if(isset($_SESSION['error'])){ echo $_SESSION['error']; unset($_SESSION['error']); } ?></p>
	</div>
	<header>
		<a href="logout.php"><button id="logout"></button></a>
		<a href="settings.php"><button></button></a>		
		<a href="relations.php"><button id="relations"></button></a>	
	</header>
	<div id="welcome">
		<p><span>Witaj</span> <?php echo $_SESSION['user']; ?></p>
	</div>