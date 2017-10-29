<?php
$login_alert = false;
session_start();

// after registration jump straight into page
if (isset($_SESSION['username'])) {
	$_POST['username'] = $_SESSION['username'];
	$_POST['password'] = $_SESSION['password'];
}

if (isset($_POST['username']) ) {

	$servername = "localhost";
	$usernam = "root";
	$passwor = "";
	$database = "dices";

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$database", $usernam, $passwor);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM users";

		$sql .= " WHERE username='" . $_POST['username'] . "'";
		$statement = $conn->query($sql);
		$response = $statement->fetch(PDO::FETCH_ASSOC);

		$conn = null;

	} catch(PDOException $e) { 
		echo $e->getMessage(); 
	}
	$hash = $response['password'];
	$password = $_POST['password'];

	if ( password_verify($password, $hash) && $_POST['password'] != "") {

		$_SESSION['username'] = $_POST['username'];
		$_SESSION['last_login'] = date("Y-m-d H:m:s");

		// setcookie("sausainis_username", $response['username'], time() + (60*60*24), "/");

	} else {
		$login_alert = true;
	}
	

} elseif (isset($_POST['logout'])) {

	session_destroy();
	$_SESSION = null;
} 

if(isset($_SESSION['username']) && $_SESSION['username'] != "") {
	header("Location: index.php");
} else {
	// echo "You are guest";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Dices Login</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
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
					<a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
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
			<?php if($login_alert){ ?>
			<div class="alert alert-danger my-5" role="alert">
				Login Failed
			</div>
			<?php } ?>

			<h2 class="form-signin-heading my-3">Please sign in</h2>
			<label for="username" class="sr-only">Username</label>
			<input type="text" id="username" name="username" class="form-control" placeholder="Email username" autofocus="">
			<label for="password" class="sr-only">Password</label>
			<input type="password" id="password" class="form-control" name="password" placeholder="Password">

			<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
			<a class="btn btn-lg btn-success btn-block" href="register.php">Register</a>
		</form>
	</div>

</body>
</html>