<?php
require_once 'header.php';
if(!isset($_POST['deleteActive']) && !isset($_POST['delete'])){
	header('Location: ./relations.php');
	exit();
}
require_once '../connect.php';
$connect = @new mysqli($dbServer, $dbUser, $dbPassword, $dbName);
if(mysqli_connect_errno()){
	$error = 'Brak połączenia z bazą';
}
else{
	$connect->query('set names "utf8" collate "utf8_polish_ci"');
	$position = $_POST['id'];
	if(isset($_POST['deleteActive'])){
		$result = @$connect->prepare('DELETE FROM Relations WHERE (FirstPerson = ' . $position . ' AND SecondPerson = ' . $id . ') OR (SecondPerson = ' . $position . ' AND FirstPerson = ' . $id . ')');
	}	
	if(isset($_POST['delete'])){
		$result = @$connect->prepare('DELETE FROM Relations WHERE Id = ' . $position);
	}
	$result->execute();	
	$result->close();
	$connect->close();
	header('Location: ./relations.php');
}
?>