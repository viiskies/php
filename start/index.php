<?php

// $row = $argv[1];
// $column = $argv[2];
// $symbol = '#';


// echo "\n";
// for ($i=0; $i < $row; $i++) {
// 	echo "    ";

// 	for ($j=0; $j < $column; $j++) { 
// 		echo $symbol;
// // 	}
// // 	echo "\n";
// // }

// function suma (int $a, int $b)  {
// 	echo $a + $b;
// }

// function getPrice (int $costPrice, int $VAT)  {
// 	$retailPrice = ($costPrice * 1.5) * (1 + $VAT/100);
// 	echo $retailPrice;
// }

// function getVolume (int $a, int $b, int $c)  {
// 	$volume = $a * $b * $c;
// 	echo $volume;
// }

function show (string $symbol, int $a)  {
	for ($i=0; $i <$a ; $i++) { 
		echo $symbol;
	}

}

function draw (string $symbol, int $col , int $row) {
	for ($i=0; $i <$row ; $i++) { 
		for ($j=0; $j < $col; $j++) { 
			echo $symbol;
		}
	}
}

function calcWheel (int $tyreHeight, int $rimDiameter, int $arcHeight) {

	$totalHeight = $tyreHeight * 2 + $rimDiameter * 2.54 * 10;
	echo $arcHeight > $totalHeight ? "ratas telpa" : "ratas netelpa";
}


// function countUp(int $min, int $max, string $countingDir) {
// 	$dir = 1;
// 	if ($countingDir == 'false') {
// 		$current_min = $min;
// 		$current_max = $max;
// 		$max = $current_min;
// 		$min = $current_max;
// 		echo $max, $min;
// 		$dir = -1;
// 	} 

	// for ($i=10; $i <= 1; $i += -1) { 

	// 	echo $i . "\n";

	// }
// }


function times_table($num) {
	$times_arr = [];
	for ($i=0; $i <= 9 ; $i++) { 
		array_push($times_arr, $i*$num);
	}

	print_r($times_arr);
}

function generate() {
	for ($i=0; $i <= 9 ; $i++) { 
		times_table($i);
	}
}




function getVolume($height, $width, $length) {
	return $height * $width * $length;
}

function getTanks(int $volume, int $tank_volume) {
	return ceil($volume/$tank_volume);
}

function generateVolumes() {
	for ($i=3; $i <=20 ; $i++) { 
		echo 

		getVolume($i, 2, 20) 
		. "\t" 
		. getTanks(getVolume($i, 2, 20), 200)
		. "\n";
	}
}



// function get_total_area($width, $length) {
// 	$total_areas = [];
// 	for ($height=5.5; $height <= 6.5; $height += 0.1) { 
// 		array_push($total_areas, ($height * $width * 2 + $height * $length * 2 + $width  * $length));
// 	}
// 	return $total_areas;

// }

function get_tiles($width, $length, $height, $tile_height, $tile_width) {
	$tile = $tile_width * $tile_height;
	$area = $height * $width * 2 + $height * $length * 2 + $width  * $length;
	return ceil($area / $tile);
}


function get_packs ($tiles, $pack_size) {
	return ceil($tiles / $pack_size);
}

function get_table() {
	for ($i=5.5; $i <= 6.5; $i += 0.1) { 
		echo $i . "\t" . get_packs(get_tiles(2, $i, 3, 0.5, 0.3), 9) . "\t" . get_tiles(2, $i, 3, 0.5, 0.3) . "\n";
	}

}


$users = [
	["username" => "PetrasP", "name" => "Petras", "surname" => "Petrauskas"],
	["username" => "CalmLikeABee", "name" => "Romas", "surname" => "Romauskas"],
	["username" => "BandituVadz", "name" => "Tadas", "surname" => "Tadauskas"],
	["username" => "SweetWeed", "name" => "Vytas", "surname" => "Vytautas"],
	["username" => "uzLietuva", "name" => "Dalia", "surname" => "Grybauskaite"]
];

	
function get_usernames() {

	global $users;
	asort($users);

	foreach ($users as $user) {
		echo $user["username"] . "\n";
	}

}


function get_rand_username() {

	global $users;
 	$random = rand(0, 4);
	echo $users[$random]["username"];
	

}





$fileName = array_shift($argv);
$funcName = array_shift($argv);


// get_usernames($users);

call_user_func_array($funcName, $argv);