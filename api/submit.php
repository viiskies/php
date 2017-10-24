<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "students";

if(!empty($_POST['inputName'])) {

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


		$inputName = $_POST['inputName'];
		$inputLastName = $_POST['inputLastName'];
		$inputPhone = $_POST["inputPhone"];
		$inputEmail = $_POST["inputEmail"];
		$inputPassword = $_POST["inputPassword"];

		$sql->execute();
		$conn = null;

	}
	catch(PDOException $e)
	{
		echo "Connection failed: " . $e->getMessage();
	}


}