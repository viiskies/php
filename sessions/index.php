<pre>
<?php
	session_start();

	if (isset($_POST['username'])) {

		$servername = "localhost";
		$usernam = "root";
		$passwor = "";
		$database = "regitra";

		if (!empty($_POST['inputName'])) {

			try {
				$conn = new PDO("mysql:host=$servername;dbname=$database", $usernam, $passwor);
			// set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "SELECT * FROM users";

				$userN = "WHERE username='" + $_POST['username'] + "'";
				$statement = $conn->query($sql);
				$response = $statement->fetch(PDO::FETCH_ASSOC);

				$conn = null;

			} catch(PDOException $e) {
				$response['message'] = ['type' => 'danger','body' =>  $e->getMessage()];
			}


	// if ($_POST['username'] == $response['username']) {
	// 	if ($_POST['password'] == $response['password']) {

	// 		$_SESSION['username'] = $_POST['username'];
	// 		$_SESSION['admin'] = true;
	// 		$_SESSION['last_login'] = date("Y-m-d H:m:s");
	// 	} else {
	// 		echo "Wrong pass";
	// 	}
	// } else {
	// 	echo "Wrong username";
	// }

		 else if (isset($_POST['logout'])) {

			session_destroy();
			$_SESSION = null;

		} 
	}
	print_r($_SESSION);
?>
</pre>
<!DOCTYPE html>
<html>
<head>
<title></title>
</head>
<body>
	<form method="POST">
		<input type="text" name="username"><br>
		<input type="password" name="password"><br>
		<input type="submit" value="Login"><br>
	</form>
	<form method="POST">
		<input type="submit" name="logout" value="Logout"><br>

	</form>

</body>
</html>