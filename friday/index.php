<?php 
$fileW = fopen("error.log", "r") or die ("Unable to open a file!");
$errors = [];

for ($i=1; !feof($fileW); $i++) { 
	$error = explode(",", fgets($fileW));
	$errors[] = $error;
}
fclose($fileW);
array_pop($errors);

$servername = "localhost";
$username = "root";
$password = "";
$database = "fake_app";

// try {
// 	$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
//     // set the PDO error mode to exception
// 	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// 	foreach ($errors as $value) {
// 		$sql = "INSERT INTO errors (time, file, error) VALUES ('" . $value[0] . "', '" . $value[1] . "', '" . $value[2] . "')";
// 		// print($sql);
// 		$conn->exec($sql);
// 	}
// }
// catch(PDOException $e)
// {
// 	echo "Connection failed: " . $e->getMessage();
// }


try {
	$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$q = $conn->prepare("SELECT * FROM errors");
	$q->execute();

	$result = $q->fetchALL(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo "Connection failed: " . $e->getMessage();
}?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Error logs</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col py-3">
				<h1 class="text-center">Klaidos</h1>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<table class="table table-striped">
					<thead class="thead-inverse">
						<tr>
							<th>#</th>
							<th>Time</th>
							<th>Location</th>
							<th>Error</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($result as $error) {
							echo "<tr>";

							foreach ($error as $value) {
								echo "<td>". $value . "</td>";
							}
							echo "</tr>";
						}?>
					</tbody>
				</table>
			</div>
		</div>
	</div>


	<!-- jQuery first, then Tether, then Bootstrap JS. -->
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>