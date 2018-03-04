<?php
require_once 'header.php';
require_once '../connect.php';
$connect = @new mysqli($dbServer, $dbUser, $dbPassword, $dbName);
if(mysqli_connect_errno()){
	$error = 'Brak połączenia z bazą';
}
else{
	$connect->query('set names "utf8" collate "utf8_polish_ci"');
}
?>
	<div id="container">
		<div id="activeFriends">
			<div id="search">
				<input type="text" placeholder="Przeszukaj swoich znajomych" id="searchFriend">
			</div>
			<h3>Twoi znajomi</h3>
			<?php
			if(!isset($error)){
				$result = @$connect->query("SELECT Users.Id, Users.FirstName, Users.LastName, Users.Color FROM Users CROSS JOIN Relations WHERE (Users.Id = Relations.FirstPerson AND Relations.Status = 'accept' AND Relations.SecondPerson = '$id') OR (Users.Id = Relations.SecondPerson AND Relations.Status = 'accept' AND Relations.FirstPerson = '$id') ORDER BY Users.FirstName");
				while($person = mysqli_fetch_array($result)){
			?>
			<div class="personAccept">
				<img <?php echo 'style="background-color: rgb(' . $person['Color'] . ');"'; ?> src="../image/logo.png" alt="" />
				<form action="./delete.php" method="POST">
					<input type="hidden" name="id" <?php echo 'value="' . $person['Id'] . '"'; ?>>
					<input type="submit" name="deleteActive" class="trash" value="">
				</form>
				<div class="personData">
					<p class="firstNameAccept"><?php echo $person['FirstName']; ?></p>
					<p class="lastNameAccept"><?php echo $person['LastName']; ?></p>
				</div>
			</div>
			<?php
				}
				$result->close();
			}
			?>
		</div>
		<div id="notYet">
			<div id="waitingForAccept">
				<h3>Oczekujące na akceptację</h3>
				<?php
				if(!isset($error)){
					$result = @$connect->query("SELECT Users.FirstName, Users.LastName, Users.Color, Relations.Id FROM Users INNER JOIN Relations ON Users.Id = Relations.FirstPerson WHERE Relations.SecondPerson = '$id' AND Relations.Status = 'wait'");
					while($person = mysqli_fetch_array($result)){
				?>
				<div class="person">
					<img <?php echo 'style="background-color: rgb(' . $person['Color'] . ');"'; ?> src="../image/logo.png" alt="" />
					<form action="./decision.php" method="POST">
						<div class="decision">
							<input type="hidden" name="id" <?php echo 'value="' . $person['Id'] . '"'; ?>>
							<input type="submit" name="yes" class="yes" value="TAK">
							<input type="submit" name="no" class="no" value="NIE">
						</div>
					</form>
					<div class="personData">
						<p class="firstName"><?php echo $person['FirstName']; ?></p>
						<p class="lastName"><?php echo $person['LastName']; ?></p>
					</div>
				</div>
				<?php
					}
					$result->close();
				}	
				?>
				<div class="clear"></div>
			</div>
			<div id="sentInvitations">
				<h3>Wysłane zaproszenia</h3>
				<?php
				if(!isset($error)){
					$result = @$connect->query("SELECT Users.FirstName, Users.LastName, Users.Color, Relations.Id FROM Users INNER JOIN Relations ON Users.Id = Relations.SecondPerson WHERE Relations.FirstPerson = '$id' AND Relations.Status = 'wait'");
					while($person = mysqli_fetch_array($result)){
				?>
				<div class="person">
					<img <?php echo 'style="background-color: rgb(' . $person['Color'] . ');"'; ?> src="../image/logo.png" alt="" />
					<form action="./delete.php" method="POST">
						<input type="hidden" name="id" <?php echo 'value="' . $person['Id'] . '"'; ?>>
						<input type="submit" name="delete" class="trash" value="">
					</form>
					<div class="personData">
						<p class="firstName"><?php echo $person['FirstName']; ?></p>
						<p class="lastName"><?php echo $person['LastName']; ?></p>
					</div>
				</div>
				<?php
					}
					$result->close();
				}
				?>
				<div class="clear"></div>
				<button id="addFriend">Nowe zaproszenie</button>
				<form action="./addFriend.php" method="POST" id="addNewFriend">
					<input type="text" name="person" placeholder="Imię i nazwisko" id="newFriend">
					<input type="submit" name="add" id="add" value="Zaproś">
				</form>
				<?php
				$connect->close();
				?>
			</div>
		</div>
	</div>
</body>
</html>