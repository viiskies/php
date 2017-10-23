<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "students";

try {
	$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$q = $conn->prepare("SELECT * FROM users");
	$q->execute();

	$result = $q->fetchALL(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "Connection failed: " . $e->getMessage();
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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="text-center">Users</h1>
		</div>
		<div class="row">
			<div class="col-6">
				<h3 class="text-center">List</h3>
				<table class="table table-striped">
					<thead class="thead-inverse">
						<tr>
							<th>id</th>
							<th>name</th>
							<th>last name</th>
							<th>phone</th>
							<th>email</th>
							<th>password</th>
						</tr>
					</thead>
					<tbody id="user_table_body">

					</tbody>
				</table>
			</div>
			<div class="col-6">
				<h3 class="text-center">Register</h3>
				<div id="alert"></div>
				<input id="filter" type="text" name="">

				<div class="form-group">
					<label for="inputName">Name</label>
					<input type="text" class="form-control" name="inputName" id="inputName" placeholder="Enter name">
				</div>
				<div class="form-group">
					<label for="inputLastName">Last Name</label>
					<input type="text" class="form-control" name="inputLastName" id="inputLastName" placeholder="Enter last name">
				</div>
				<div class="form-group">
					<label for="inputPhone">Phone number</label>
					<input type="text" class="form-control" name="inputPhone" id="inputPhone" placeholder="Enter number">
				</div>
				<div class="form-group">
					<label for="inputEmail">Email address</label>
					<input type="email" class="form-control" name="inputEmail" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
				</div>
				<div class="form-group">
					<label for="inputPassword">Password</label>
					<input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Password">
				</div>
				<input id="ajax_post" type="button" class="btn btn-primary" value="AJAX POST">

			</div>
		</div>
	</div>
	<!-- jQuery first, then Tether, then Bootstrap JS. -->

<!-- 	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script> -->
	<script type="text/javascript" src="js/script.js" ></script>
</body>
</html>