<!DOCTYPE html>
<html>
<head>
	<title>Facebook</title>
	<meta charset="utf-8" />
	<link href="login.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<div id="wrapper">
		<form id="logOn" method="POST" action="login.php">
			<img id="logo" src="image/logo.png" alt="logo" />
			<div id="data">
				<label for="login">Nazwa użytkownika</label>
				<input type="text" name="login" />
				<label for="password">Hasło</label>
				<input type="password" name="password" />
				<input id="button" type="submit" name="logOn" value="Zaloguj" />
			</div>
		</form>
	</div>
</body>
</html>