<?php 

header("Content-type:application/json");

$servername = "localhost";
$username = "root";
$password = "";
$database = "regitra";

if(isset($_POST['owner']) && $_POST['owner'] != "") {

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = $conn->prepare("INSERT INTO cars (owner, license, model, make, date) VALUES (:owner, :license, :model, :make, NOW())");

		$sql->bindParam(':owner', $owner);
		$sql->bindParam(':license', $license);
		$sql->bindParam(':model', $model);
		$sql->bindParam(':make', $make);


		$owner = htmlspecialchars($_POST['owner']);
		$license = $_POST['license'];
		$model = $_POST["model"];
		$make = $_POST["make"];


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
	$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM cars";

	if(isset($_GET['filter']) && $_GET['filter'] != "") {
		$makefilter = $_GET['filter'];
		$sql .=  " WHERE make='" . $makefilter . "'";
	}

	if(isset($_GET['search']) && $_GET['search'] != "" && $_GET['filter'] != "" && isset($_GET['filter'])) {
		$ownerfilter = $_GET['search'];
		$sql .=  " AND owner LIKE '%" . $ownerfilter . "%'";

	} else if (isset($_GET['search']) && $_GET['search'] != "") {
		$ownerfilter = $_GET['search'];
		$sql .=  " WHERE owner LIKE '%" . $ownerfilter . "%'";
	}

	if(isset($_GET['last10']) && $_GET['last10'] == "true") {
		$sql .=  " ORDER BY date DESC LIMIT 2";
	}


	$statement = $conn->query($sql);
	$response['cars'] = $statement->fetchAll(PDO::FETCH_ASSOC);

	$sql = "SELECT make FROM cars GROUP BY make";
	$statement = $conn->query($sql);
	$response['makers'] = $statement->fetchAll(PDO::FETCH_ASSOC);

	$conn = null;

} catch(PDOException $e) {
	$response['message'] = ['type' => 'danger','body' =>  $e->getMessage()];
}
echo json_encode($response);