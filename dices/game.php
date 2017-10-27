<?php 
session_start();
header("Content-type:application/json");

$servername = "localhost";
$username = "root";
$password = "";
$database = "dices";

if(isset($_GET['username']) && $_GET['username'] != "") {

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = $conn->prepare("SELECT * FROM games WHERE username = :username");

		$sql->bindParam(':username', $playerName);
		$playerName = $_GET['username'];

		$sql->execute();
		$response['games'] = $sql->fetchAll(PDO::FETCH_ASSOC);

		$conn = null;

	} catch(PDOException $e) {
		$response['message'] = ['type' => 'danger','body' => $e->getMessage()];
	}
} 

elseif(isset($_GET['top']) && $_GET['top'] != "") {

	try {
		// die();
		$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "SELECT * FROM games ORDER BY winings DESC LIMIT " . $_GET['top'] ."";

		$statement = $conn->query($sql);

		$response['games'] = $statement->fetchAll(PDO::FETCH_ASSOC);

		$conn = null;

	} catch(PDOException $e) {
		$response['message'] = ['type' => 'danger','body' => $e->getMessage()];
	}
} 

elseif(isset($_POST['winings']) && $_POST['winings'] != "") {
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = $conn->prepare("INSERT INTO games (username, roll1, roll2, roll3, roll4, winings, date) VALUES (:username, :roll1, :roll2, :roll3, :roll4, :winings, NOW())");

		$sql->bindParam(':username', $username);
		$sql->bindParam(':roll1', $roll1);
		$sql->bindParam(':roll2', $roll2);
		$sql->bindParam(':roll3', $roll3);		
		$sql->bindParam(':roll4', $roll4);
		$sql->bindParam(':winings', $winings);

		$username = $_SESSION['username'];
		$roll1 = $_POST['roll1'];
		$roll2 = $_POST['roll2'];
		$roll3 = $_POST['roll3'];
		$roll4 = $_POST['roll4'];
		$winings = $_POST['winings'];


		$sql->execute();
		$conn = null;
		$response['message'] = ['type' => 'success','body' => 'User was added'];

	} catch(PDOException $e) {
		$response['message'] = ['type' => 'danger','body' => $e->getMessage()];
	}
} 


else  {
	// die();
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM games";

		$statement = $conn->query($sql);
		$response['games'] = $statement->fetchAll(PDO::FETCH_ASSOC);

		$conn = null;

	} catch(PDOException $e) {
		$response['message'] = ['type' => 'danger','body' =>  $e->getMessage()];
	}
}
echo json_encode($response);