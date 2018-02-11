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
	<link href="login.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<p>Witaj <?php echo $_SESSION['user'] . ' ' . $_SESSION['userSurname']; ?></p>
	<a href="logout.php"><button>Wyloguj</button></a>
</body>
</html>