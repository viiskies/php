<?php if(isset($_FILES) && $_FILES['name'] != '' && isset($_POST['file_submit'])) { 
	print_r($_FILES);
	// $target_dir = "uploads/";
	$target_file = basename($_FILES["fileToUpload"]["name"]);
	if (pathinfo($target_file,PATHINFO_EXTENSION) == "csv") {
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		$my_file = fopen($target_file, "r") or die ("unable to open file");
		
		for ($id = 1; !feof($my_file); $id++) {
			$carscsv[] = explode(",", fgets($my_file));
		}
		$servername = "localhost";
		$username = "root";
		$password = "";
		$database = "regitra";

		try {
			$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = $conn->prepare("INSERT INTO cars (owner, license, model, make, date) VALUES (:owner, :license, :model, :make, NOW())");
			
			foreach ($carscsv as $value) {
				$sql->bindParam(':owner', $owner);
				$sql->bindParam(':license', $license);
				$sql->bindParam(':model', $model);
				$sql->bindParam(':make', $make);

				$owner = $value[0];
				$license = $value[1];
				$model = $value[2];
				$make = rtrim($value[3]);

				$sql->execute();
			}
			

			$conn = null;

			header('Location: index.php?msg=' . 'CSV data was added');

		} catch(PDOException $e) {
			$response['message'] = ['type' => 'danger','body' => $e->getMessage()];
		}
	} else {
		$response['message'] = ['type' => 'warning','body' => 'No user data to submit'];
	}

} else {
	header("Location: index.php?msg=Trouble uploading&typ=warning");
}
