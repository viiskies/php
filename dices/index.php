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
	<title>Dice game</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="dice icon" href="favicon.png">


	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="animate.css">
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
			<a class="navbar-brand" href="index.php">
				<img src="favicon.png" width="30" height="30" class="d-inline-block align-top" alt="">
				Dice Game
			</a>
			<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
				<li class="nav-item active">
					<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="stats.php">Stats</a>
				</li>
			</ul>
			<form class="form-inline my-2 my-lg-0">

				<a class="btn btn-outline-success my-2 my-sm-0" href="logout.php">Logout</a>
			</form>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col d-flex justify-content-between" id="dice_table">
				<div id="dice1" class="dice"></div>
				<div id="dice2" class="dice"></div>
				<div id="dice3" class="dice"></div>
			</div>
		</div>
		<div class="row">
			<div class="col d-flex justify-content-center">
				<div id="dicegame">
					<h1>Winings:</h1>
					<h2 id="winings"></h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col d-flex justify-content-center">
				<input type="button" class="btn btn-info btn-lg mx-3" id="new_game" name="new_game" value="New game">
				<input type="button" class="btn btn-primary btn-lg" id="roll_dice" name="roll_dice" value="Roll">
			</div>
		</div>
	</div>
	<!-- jQuery first, then Tether, then Bootstrap JS. -->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/script.js" ></script>
</body>
</html>