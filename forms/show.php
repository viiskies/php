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

echo json_encode($result);