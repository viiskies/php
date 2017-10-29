<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "dices";
$sameUsername = false;
$passwordsDontMatch = false;

if(isset($_POST['name']) && $_POST['name'] != "" && $_POST['password'] != "" && $_POST['repeatPassword'] != "") {

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sqlq = "SELECT * FROM users WHERE username='" . $_POST['username'] . "'";
		$statement = $conn->query($sqlq);
		$response = $statement->fetch(PDO::FETCH_ASSOC);

		if(empty($response)) {
			if ($_POST['password'] == $_POST['repeatPassword']) {

				$sql = $conn->prepare("INSERT INTO users (name, username, password) VALUES (:name, :username, :password)");

				$sql->bindParam(':name', $name);
				$sql->bindParam(':username', $username);
				$sql->bindParam(':password', $password);

				$name = $_POST['name'];
				$username = $_POST['username'];
				$password = password_hash($_POST["password"], PASSWORD_DEFAULT); 

				$sql->execute();
				session_start();

				$_SESSION['username'] = $username; 
				$_SESSION['password'] = $_POST["password"];

				$response['message'] = ['type' => 'success','body' => 'User was added'];
				$conn = null;
				header("Location: login.php");
			} else {
				$passwordsDontMatch = true; 
			}

		} else {
			$sameUsername = true;
		}

		

	} catch(PDOException $e) {
		$response['message'] = ['type' => 'danger','body' => $e->getMessage()];
	}
} else {
	$response['message'] = ['type' => 'warning','body' => 'No user data to submit'];
} ?>


<!doctype html>
<html lang="en">
<head>
	<title>Dice game Registration</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
			<a class="navbar-brand" href="#">
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
				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			</form>
		</div>
	</nav>
	<div class="container">
		<form class="form-signin" method="POST">
			<?php if($sameUsername){ ?>
			<div class="alert alert-danger my-5" role="alert">
				Same username
			</div>
			<?php } ?>
			<?php if($passwordsDontMatch){ ?>
			<div class="alert alert-danger my-5" role="alert">
				Passwords don't match
			</div>
			<?php } ?>
			<h2 class="form-signin-heading">Please register</h2>

			<label for="name" class="sr-only">Name</label>
			<input type="text" id="name" name="name" class="form-control" placeholder="Enter name"  autofocus="">

			<label for="username" class="sr-only">Username</label>
			<input type="text" id="username" name="username" class="form-control" placeholder="Enter username"  autofocus="">

			<label for="password" class="sr-only">Password</label>
			<input type="password" id="password" class="form-control" name="password" placeholder="Password" >      

			<label for="repeatPassword" class="sr-only">Repeat password</label>
			<input type="password" id="repeatPassword" class="form-control" name="repeatPassword" placeholder="Repeat a password" >


			<input type="submit" name="register" value="Register" class="btn btn-lg btn-success btn-block">
			<a class="btn btn-lg btn-primary btn-block" href="login.php">Back to login</a>

		</form>
	</div>


	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>