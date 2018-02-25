<?php
require_once 'header.php';
if(!isset($_POST['yes']) && !isset($_POST['no'])){
	header('Location: ./relations.php');
	exit();
}
require_once '../connect.php';
$connect = @new mysqli($dbServer, $dbUser, $dbPassword, $dbName);
if(mysqli_connect_errno()){
	$_SESSION['error'] = 'Brak połączenia z bazą';
}
else{
	$connect->query('set names "utf8" collate "utf8_polish_ci"');
	$position = $_POST['id'];
	if(isset($_POST['yes'])){
		$result = @$connect->prepare('UPDATE Relations SET Status = "accept" WHERE Id = ' . $position);
	}
	if(isset($_POST['no'])){
		$result = @$connect->prepare('DELETE FROM Relations WHERE Id = ' . $position);
	}
	$result->execute();	
	$result->close();
	$connect->close();
	header('Location: ./relations.php');
}
?>