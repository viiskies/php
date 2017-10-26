<?php 
session_start();
if (isset($_SESSION['username'])) {
} else {
	// user is a guest
	header('Location: login.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Forms</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col" id="dice_table">
				<div class="dice" id="dice1"></div>
				<div class="dice" id="dice2"></div>
				<div class="dice" id="dice3"></div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div id="dicegame">

					<ul>

					</ul>
					<h1>Winings:</h1>
					<h2 id="winings"></h2>
				</div>
				<a href="logout.php">Logout</a>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<input type="button" id="new_game" name="new_game" value="New game">
				<input type="button" id="roll_dice" name="roll_dice" value="Roll">
			</div>
		</div>
	</div>
	<!-- jQuery first, then Tether, then Bootstrap JS. -->

<!-- 	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script> -->
	<script type="text/javascript" src="js/script.js" ></script>
</body>
</html>