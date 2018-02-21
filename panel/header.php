<?php
	session_start();
	if(!isset($_SESSION['online'])){
		header('Location: ../');
		exit();
	}
?>
<!DOCTYPE html>
</html>
<head>
	<title>Social-network</title>
	<meta charset="utf-8" />
	<link href="default.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<header>
		<nav>
			<p>Witaj <?php echo $_SESSION['user'] . ' ' . $_SESSION['userSurname']; ?></p>
		</nav>
		<a href="logout.php"><button id="logout"></button></a>	
		<a href="relations.php"><button></button></a>	
	</header>