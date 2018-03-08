<?php
session_start();
if(!isset($_SESSION['online'])){
	header('Location: ../');
	exit();
}
require_once '../connect.php';
$connect = @new mysqli($dbServer, $dbUser, $dbPassword, $dbName);
if(mysqli_connect_errno()){
	$error = 'Brak połączenia z bazą';
}
else{
	$connect->query('set names "utf8" collate "utf8_polish_ci"');
}
$id = $_SESSION['id'];
$result = @$connect->query("SELECT count(*) FROM Users INNER JOIN Relations ON Users.Id = Relations.FirstPerson WHERE Relations.SecondPerson = '$id' AND Relations.Status = 'wait'");
if($result->num_rows > 0){
	$row = $result->fetch_assoc();
}
$result->close();
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
	else{
	?>
	<script src="settings.js"></script>
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
		<a href="settings.php"><button id="settings"></button></a>		
		<a href="relations.php"><button id="relations"><?php if($row['count(*)'] != 0){ echo '<div class="count">' . $row['count(*)'] . '</div>';} ?></div></button></a>	
	</header>
	<div id="welcome">
		<p><span>Witaj</span> <?php echo $_SESSION['user']; ?></p>
	</div>