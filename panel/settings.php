<?php
require_once 'header.php';
if(isset($_POST['changeColor'])){
	$color = $_POST['color'];
	$avatar = $_POST['avatarNumber'];
	$result = @$connect->prepare('UPDATE Users SET Color = "' . $color . '", Logo = "' . $avatar . '" WHERE Id = ' . $_SESSION['id']);
	$result->execute();
	$result->close();
}
if($result = @$connect->query('SELECT Color, Logo FROM Users WHERE Id = ' . $_SESSION['id'])){
	if($result->num_rows > 0){
		$row = $result->fetch_assoc();
		$background = $row['Color'];
		$logo = $row['Logo'];
		$partColor = explode(', ', $background);
		$red = $partColor[0];
		$green = $partColor[1];
		$blue = $partColor[2];
		$result->close();
	}
}
$connect->close();
?>
	<div id="container">
		<div id="profile">
			<div id="avatar" <?php echo 'style="background-color: rgb(' . $background . ');"> <img id="cos" src="../image/avatar' . $logo . '.png" alt="" /';?>></div>
			<form action="./settings.php" method="POST">
				<input id="color" type="hidden" name="color" <?php echo 'value="' . $background . '"'; ?>>
				<input id="avatarNumber" type="hidden" name="avatarNumber" <?php echo 'value="' . $logo . '"'; ?>>
				<input id="save" type="submit" name="changeColor" value="Zapisz zmiany">
			</form>
		</div>
		<div id="sliders">
			<h3>Wybierz kolor tła</h3>
			<p class="value"><?php echo $red; ?></p>
			<p class="colorText">Czerwony</p>
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
			<p class="colorText">Zielony</p>
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
			<p class="colorText">Niebieski</p>
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
		<div id="logo">
			<h3>Wybierz swoje logo</h3>
			<div id="chooseLogo">
				<?php
				for($i = 0; $i < 8; $i++){
					$index = $i + 1;
					if($i + 1 == $logo){
					?>
					<div class="avatar activeAvatar"><?php echo '<img src="../image/avatar' . $index . '.png" alt="" />'; ?></div>
					<?php
					}
					else{
					?>
					<div class="avatar"><?php echo '<img src="../image/avatar' . $index . '.png" alt="" />'; ?></div>
					<?php
					}
				}
				?>
				
				<div class="clear"></div>
			</div>
		</div>
	</div>
</body>
</html>