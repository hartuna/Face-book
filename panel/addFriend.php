<?php
require_once 'header.php';
if(!isset($_POST['add'])){
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
	$person = $_POST['person'];
	$name = explode(' ', $person);
	if($result = @$connect->query("SELECT Id FROM Users WHERE FirstName = '$name[0]' AND LastName = '$name[1]'")){
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			$idNewFriend = $row['Id'];
		}
		else{
			$_SESSION['error'] = 'Brak podanej osoby w bazie';
		}
		$result->close();
	}
	if($idNewFriend != $_SESSION['id']){
		if($result = @$connect->query('SELECT Id FROM Relations WHERE (FirstPerson = ' . $idNewFriend . ' AND SecondPerson = ' . $_SESSION['id'] . ') OR (SecondPerson = ' . $idNewFriend . ' AND FirstPerson = ' . $_SESSION['id'] . ')'))	{
			if($result->num_rows > 0){
				$_SESSION['error'] = 'Relacja już została nawiązana';
			}
			else{
				$result->close();
				$wait = 'wait';
				$result = @$connect->prepare('INSERT Relations (FirstPerson, SecondPerson, Status) VALUES (?, ?, ?)');
				$result->bind_param('iis', $_SESSION['id'], $idNewFriend, $wait);
				$result->execute();
			}
			$result->close();
		}	
	}
	else if($idNewFriend == $_SESSION['id'] && isset($idNewFriend)){
		$_SESSION['error'] = 'Zapraszasz sam siebie?';
	}
	$connect->close();
	header('Location: ./relations.php');
}
?>