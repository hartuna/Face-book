<?php
	session_start();
	if(isset($_SESSION['online']) && $_SESSION['online'] == true){
		header('Location: /social-network/panel/index.php');
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Social-network</title>
	<meta charset="utf-8" />
	<link href="login.css" rel="stylesheet" type="text/css" media="all" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
	<div id="wrapper">
		<form id="logOn" method="POST" action="login.php">
			<img id="logo" src="image/logo.png" alt="logo" />
			<div id="data">
				<label for="login">Nazwa użytkownika</label>
				<input type="text" name="login" <?php if(isset($_SESSION['login'])){ echo 'value="' . $_SESSION['login'] . '"'; } ?>>
				<label for="password">Hasło</label>
				<input type="password" name="password">
				<input id="button" type="submit" name="logOn" value="Zaloguj">
			</div>
		</form>
		<div id="bottom">
			<p>Aplikacja powstała w celach edukacyjnych</p>
			<p>Przykładowe dane znajdziesz <a href="#">tutaj</a></p>
		</div>
	</div>
</body>
</html>