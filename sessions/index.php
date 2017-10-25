<pre>
	<?php
	session_start();

	if (isset($_POST['username'])) {

		$servername = "localhost";
		$usernam = "root";
		$passwor = "";
		$database = "regitra";

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

		if ($response['password'] == $_POST['password'] && $_POST['password'] != "") {

			$_SESSION['username'] = $_POST['username'];
			$_SESSION['level'] = $response['level'];
			$_SESSION['last_login'] = date("Y-m-d H:m:s");

			setcookie("sausainis_username", $response['username'], time() + (60*60*24), "/");

		} else {
			echo "Try again.";
		}
		

	} elseif (isset($_POST['logout'])) {

		session_destroy();
		$_SESSION = null;
	} 

	print_r($_SESSION);

	if(isset($_COOKIE['sausainis_username'])) {
		echo "Labas, " . $_COOKIE["sausainis_username"];
	}
	?>
</pre>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST">
		<input type="text" name="username" placeholder="Username"><br>
		<input type="password" name="password" placeholder="Password"><br>
		<input type="submit" value="Login"><br>
	</form>
	<form method="POST">
		<input type="submit" name="logout" value="Logout"><br>
	</form>
	<?php if(isset($_SESSION['level']) && $_SESSION['level'] > 0) {
		echo "You are admin";
	} elseif (isset($_SESSION['level']) && $_SESSION['level'] == 0) {
		echo "You are basic user";
	} else {
		echo "You are guest";
	}
	?>

</body>
</html>