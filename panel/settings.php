<?php
require_once 'header.php';
require_once '../connect.php';
$connect = @new mysqli($dbServer, $dbUser, $dbPassword, $dbName);
if(mysqli_connect_errno()){
	$error = 'Brak połączenia z bazą';
}
else{
	$connect->query('set names "utf8" collate "utf8_polish_ci"');
	if(isset($_POST['changeColor'])){
		$color = $_POST['color'];
		$result = @$connect->prepare('UPDATE Users SET Color = "' . $color . '" WHERE Id = ' . $_SESSION['id']);
		$result->execute();
		$result->close();
	}
	if($result = @$connect->query('SELECT Color FROM Users WHERE Id = ' . $_SESSION['id'])){
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			$background = $row['Color'];
			$partColor = explode(', ', $background);
			$red = $partColor[0];
			$green = $partColor[1];
			$blue = $partColor[2];
			$result->close();
		}
	}
	$connect->close();
}
?>
	<div id="container">
		<h1>Zbuduj swój awatar</h1>
		<div id="avatar" <?php echo 'style="background-color: rgb(' . $background . ');"'; ?>></div>
		<div id="sliders">
			<p class="value"><?php echo $red; ?></p>
			<div class="slide" id="red">
				<?php
				for($i = 0; $i < 7; $i++){
					if(($i + 1) * 32 != $red){
					?>
					<div class="partSlideRed"></div>
					<?php
					}
					else{
					?>
					<div class="partSlideRed activeSlide"></div>
					<?php
					}
				}
				?>
			</div>
			<p class="value"><?php echo $green; ?></p>
			<div class="slide" id="green">
				<?php
				for($i = 0; $i < 7; $i++){
					if(($i + 1) * 32 != $green){
					?>
					<div class="partSlideGreen"></div>
					<?php
					}
					else{
					?>
					<div class="partSlideGreen activeSlide"></div>
					<?php
					}
				}
				?>
			</div>
			<p class="value"><?php echo $blue; ?></p>
			<div class="slide" id="blue">
				<?php
				for($i = 0; $i < 7; $i++){
					if(($i + 1) * 32 != $blue){
					?>
					<div class="partSlideBlue"></div>
					<?php
					}
					else{
					?>
					<div class="partSlideBlue activeSlide"></div>
					<?php
					}
				}
				?>
			</div>
		</div>
		<form action="./settings.php" method="POST">
			<input id="color" type="hidden" name="color" value="32, 32, 32">
			<input type="submit" name="changeColor" value="Zapisz">
		</form>
	</div>
</body>
</html>