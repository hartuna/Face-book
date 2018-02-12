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
	<script src="login.js"></script>
</head>
<body>
	<div id="error">
		<p id="statement"><?php if(isset($_SESSION['error'])){ echo $_SESSION['error']; } ?></p>
	</div>
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
			<p>Przykładowe dane znajdziesz <span id="openUsers">tutaj</span></p>
		</div>
	</div>
	<div id="users">
		<div id="table">
			<button id="close">Close</button>
			<table>
				<tr>
					<th>Login</th>
					<th>Hasło</th>
				</tr>
				<?php
					require_once 'connect.php';
					$connect = @new mysqli($dbServer, $dbUser, $dbPassword, $dbName);
					if(mysqli_connect_errno()){
						echo 'Brak połączenia z bazą';
					}
					else{
						$connect->query('set names "utf8" collate "utf8_polish_ci"');
						$result = @$connect->query("SELECT * FROM Users LIMIT 10");
						while($value = mysqli_fetch_array($result)){
				?>
				<tr>
					<td><?php echo $value['Login']; ?></td>
					<td><?php echo $value['Password']; ?></td>
				</tr>
				<?php
						}
						$result->close();
						$connect->close();
					}
				?>
			</table>
		</div>
	</div>
</body>
</html>