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
			<h3>Twoi znajomi</h3>
		</div>
		<div id="notYet">
			<div id="waitingForAccept">
				<h3>Oczekujące na akceptację</h3>
				<?php
					if(!isset($error)){
						$result = @$connect->query("SELECT Users.FirstName, Users.LastName FROM Users INNER JOIN Relations ON Users.Id = Relations.FirstPerson WHERE Relations.SecondPerson = '$id' AND Relations.Status = 'wait'");
						while($person = mysqli_fetch_array($result)){
						?>
						<div class="person">
							<img src="../image/logo.png" alt="" />
							<div class="decision">
								<button class="yes">TAK</button>
								<button class="no">NIE</button>
							</div>
							<div class="personData">
								<p class="firstName"><?php echo $person['FirstName']; ?></p>
								<p class="lastName"><?php echo $person['LastName']; ?></p>
							</div>
						</div>
						<?php
						}
						$result->close();
					}
					else{
						echo $error;
					}	
				?>
				<div class="clear"></div>
			</div>
			<div id="sentInvitations">
				<h3>Wysłane zaproszenia</h3>
				<?php
					if(!isset($error)){
						$result = @$connect->query("SELECT Users.FirstName, Users.LastName FROM Users INNER JOIN Relations ON Users.Id = Relations.SecondPerson WHERE Relations.FirstPerson = '$id' AND Relations.Status = 'wait'");
						while($person = mysqli_fetch_array($result)){
						?>
						<div class="person">
							<img src="../image/logo.png" alt="" />
							<button class="trash"></button>
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
					<button id="addFriend">Nowe zaproszenie</button>
					<?php
					$connect->close();
				?>
			</div>
		</div>
	</div>
</body>
</html>