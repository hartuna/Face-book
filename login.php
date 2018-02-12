<?php
session_start();
if(!isset($_POST['login']) || !isset($_POST['password'])){
	$_SESSION['error'] = 'Niepoprawny adres, zostałeś przekierowany';
	header('Location: /social-network/');
	exit();
}
require_once 'connect.php';
$connect = @new mysqli($dbServer, $dbUser, $dbPassword, $dbName);
if(mysqli_connect_errno()){
	$_SESSION['error'] = 'Nie można połączyć się z bazą';
	header('Location: /social-network/');
}
else{
	$connect->query('set names "utf8" collate "utf8_polish_ci"');
	$login = $_POST['login'];
	$password = $_POST['password'];
	if($login == ''){
		$_SESSION['error'] = 'Wprowadź login';
		header('Location: /social-network/');
	}
	else if($password == ''){
		$_SESSION['login'] = $login;
		$_SESSION['error'] = 'Wprowadź hasło';
		header('Location: /social-network/');
	}
	else{
		if($result = @$connect->query("SELECT * FROM Users WHERE Login = '$login' AND Password = '$password'")){
			if($result->num_rows > 0){
				$_SESSION['online'] = true;
				$row = $result->fetch_assoc();
				$_SESSION['id'] = $row['Id'];
				$_SESSION['user'] = $row['FirstName'];
				$_SESSION['userSurname'] = $row['LastName'];
				unset($_SESSION['error']);
				$result->close();
				header('Location: /social-network/panel/index.php');
			}
			else{
				$_SESSION['error'] = 'Błędne nazwa użytkownika lub hasło';
				header('Location: /social-network/');
			}
			$connect->close();
		}	
	}	
}
?>
