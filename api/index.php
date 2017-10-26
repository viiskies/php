<?php 
session_start();
if (isset($_SESSION['username']) && $_SESSION['level'] >= 2) {
	$superuser = true;
	$admin = true;
} elseif(isset($_SESSION['username']) && $_SESSION['level'] == 1) {
	$admin = true;
	$superuser = false;
} elseif(isset($_SESSION['username']) && $_SESSION['level'] == 0) {
	$admin = false;
	$superuser = false;
} else {
	// user is a guest
	header('Location: login.php');
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
		<div class="row py-3">
			<div class="col">
				<h1 class="text-center">reGITrar</h1>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<h3 class="text-center">List</h3>
				<table class="table table-striped">
					<thead class="thead-inverse">
						<tr>
							<th>#</th>
							<th>Owner</th>
							<th>License</th>
							<th>Model</th>
							<th>Make</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody id="cars_table_body">

					</tbody>
				</table>
			</div>
			<div class="col-4">

				<a href="logout.php">Logout</a>
				<?php if($admin) { ?>
				<h3 class="text-center">Register</h3>

				<div id="alert"></div><?php
			}?>
			<div class="form-group">
				<label for="search">Search</label>
				<input type="text" class="form-control" name="search" id="search" placeholder="Search owner">
			</div>

			<label for="filter">Make search</label>
			<select data-placeholder="Make" class="custom-select form-control"  id="filter">
			</select>
			<?php if($admin) { ?>
			<div class="form-group pt-5">
				<label for="owner">Owner</label>
				<input type="text" class="form-control" name="owner" id="owner" placeholder="Enter owner's name">
			</div>
			<div class="form-group">
				<label for="license">License #</label>
				<input type="text" class="form-control" name="license" id="license" placeholder="Enter license">
			</div>
			<div class="form-group">
				<label for="model">Model</label>
				<input type="text" class="form-control" name="model" id="model" placeholder="Enter car model">
			</div>		
			<div class="form-group">
				<label for="model">Make</label>
				<select data-placeholder="Make" class="custom-select form-control"  id="make">
					<option value=""></option>
					<option value="ACURA">ACURA</option>
					<option value="ASTON MARTIN">ASTON MARTIN</option>
					<option value="AUDI">AUDI</option>
					<option value="BENTLEY">BENTLEY</option>
					<option value="BMW">BMW</option>
					<option value="BUICK">BUICK</option>
					<option value="CADILLAC">CADILLAC</option>
					<option value="CHEVROLET">CHEVROLET</option>
					<option value="CHRYSLER">CHRYSLER</option>
					<option value="DODGE">DODGE</option>
					<option value="FERRARI">FERRARI</option>
					<option value="FORD">FORD</option>
					<option value="GMC">GMC</option>
					<option value="HONDA">HONDA</option>
					<option value="HUMMER">HUMMER</option>
					<option value="HYUNDAI">HYUNDAI</option>
					<option value="INFINITI">INFINITI</option>
					<option value="ISUZU">ISUZU</option>
					<option value="JAGUAR">JAGUAR</option>
					<option value="JEEP">JEEP</option>
					<option value="KIA">KIA</option>
					<option value="LAMBORGHINI">LAMBORGHINI</option>
					<option value="LAND ROVER">LAND ROVER</option>
					<option value="LEXUS">LEXUS</option>
					<option value="LINCOLN">LINCOLN</option>
					<option value="LOTUS">LOTUS</option>
					<option value="MASERATI">MASERATI</option>
					<option value="MAYBACH">MAYBACH</option>
					<option value="MAZDA">MAZDA</option>
					<option value="MERCEDES-BENZ">MERCEDES-BENZ</option>
					<option value="MERCURY">MERCURY</option>
					<option value="MINI">MINI</option>
					<option value="MITSUBISHI">MITSUBISHI</option>
					<option value="NISSAN">NISSAN</option>
					<option value="PONTIAC">PONTIAC</option>
					<option value="PORSCHE">PORSCHE</option>
					<option value="ROLLS-ROYCE">ROLLS-ROYCE</option>
					<option value="SAAB">SAAB</option>
					<option value="SATURN">SATURN</option>
					<option value="SUBARU">SUBARU</option>
					<option value="SUZUKI">SUZUKI</option>
					<option value="TOYOTA">TOYOTA</option>
					<option value="VOLKSWAGEN">VOLKSWAGEN</option>
					<option value="VOLVO">VOLVO</option>
				</select>
			</div>

			<input id="ajax_post" type="button" class="btn btn-primary" value="Post">
			<?php }?>

			<?php if($superuser) { ?>
			<div class="form-group pt-5">
				<form action="uploadcsv.php" method="post" enctype="multipart/form-data">
					Select file to upload:
					<input type="file" name="fileToUpload" id="fileToUpload">
					<input type="submit" value="Upload a CSV file" name="file_submit">
				</form>
			</div>

			<?php } 
			if(isset($_GET['msg'])) {
				echo '<div class="alert alert-' . $_GET['typ'] . '" role="alert">'. $_GET['msg'] .' </div>';
			}
			?>

			<input id="last10" type="button" class="btn btn-primary" value="Show last 2">

		</div>
	</div>
</div>
<!-- jQuery first, then Tether, then Bootstrap JS. -->

<!-- 	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script> -->
	<script type="text/javascript" src="js/script.js" ></script>
</body>
</html>