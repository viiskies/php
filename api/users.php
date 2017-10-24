<?php 

header("Content-type:application/json");

$servername = "localhost";
$username = "root";
$password = "";
$database = "students";

if(isset($_POST['inputName']) && $_POST['inputName'] != "") {

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = $conn->prepare("INSERT INTO users (inputName, inputLastName, inputPhone, inputEmail, inputPassword) VALUES (:inputName, :inputLastName, :inputPhone, :inputEmail, :inputPassword)");

		$sql->bindParam(':inputName', $inputName);
		$sql->bindParam(':inputLastName', $inputLastName);
		$sql->bindParam(':inputPhone', $inputPhone);
		$sql->bindParam(':inputEmail', $inputEmail);
		$sql->bindParam(':inputPassword', $inputPassword);


		$inputName = htmlspecialchars($_POST['inputName']);
		$inputLastName = $_POST['inputLastName'];
		$inputPhone = $_POST["inputPhone"];
		$inputEmail = $_POST["inputEmail"];
		$inputPassword = $_POST["inputPassword"];

		$sql->execute();
		$conn = null;
		$response['message'] = ['type' => 'success','body' => 'User was added'];
	} catch(PDOException $e) {
		$response['message'] = ['type' => 'danger','body' => $e->getMessage()];
	}
} else {
	$response['message'] = ['type' => 'warning','body' => 'No user data to submit'];
}

try {
	$conn = new PDO("mysql:host=localhost;dbname=students;charset=utf8", "root", "");
    // set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if(isset($_GET['filter']) && $_GET['filter'] != "") {
		$statement = $conn->query("SELECT * FROM users WHERE id >" . $_GET['filter']);
		$response['users'] = $statement->fetchAll(PDO::FETCH_ASSOC);
	} else {
		$statement = $conn->query("SELECT * FROM users");
		$response['users'] = $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	$conn = null;

} catch(PDOException $e) {
	$response['message'] = ['type' => 'danger','body' =>  $e->getMessage()];
}
echo json_encode($response);







