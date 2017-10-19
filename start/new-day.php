<?php 


function three($a, $b) {
	for ($i=9; $i >=0; $i--) {
		if ($i == $a || $i == $b) {
			for ($j=$i; $j >=0; $j--) { 
				echo $j;
			}
			echo "\n";
		} else {
			echo $i . "\n";	
		}
	}
}


function threes(string $numbers) {
	for ($i=9; $i >=0; $i--) {
		$searchStr = '$i';
		if (strpos($searchStr, $numbers) == false) {
			for ($j=$i; $j >=0; $j--) { 
				echo $j;
			}
			echo "\n";
		} else {
			echo $i . "\n";	
		}
	}
}

function get_lowest() {

	$temperatures = [-5, 5, 3.5, 8, 6];

	$currentMin = $temperatures[0];
	foreach ($temperatures as $value) {
		if ($value < $currentMin) {
			$currentMin = $value;
		}
	}
	echo $currentMin;


}



function get_lowest_sort() {
	
	$temperatures = [28, 5, 3.5, -5, 8, 6];

	sort($temperatures);
	echo $temperatures[0];

}



function dice($dices) {
	$game = [];
	for ($i=0; $i <$dices ; $i++) { 
		$game[] = mt_rand(1, 6);
	}
	print_r($game);
	sort($game);
	
	for ($i=0; $i < $dices-1 ; $i++) { 
		if ($game[$i] == $game[$i+1]) {
			echo "Winner";
			break;
		}
	}
}


function dices($dices) {
	// $start = microtime(true);
	$game = [];
	$winningNumbers = [];
	$winning = 0;


	for ($i=0; $i <$dices ; $i++) { 
		$game[] = rand(1, 6);
	}
	print_r($game);

	$winner = false;


	for ($i=0; $i < $dices-1 ; $i++) {
		for ($j = $i+1; $j < $dices ; $j++) { 
			if ($game[$i] == $game[$j]) {
				if ($game[$i] > 2) {
					if (!in_array($game[$i],  $winningNumbers)) {
						$winning += $game[$i] * 100;
						$winningNumbers[] += $game[$i];
					}
				}
				$winner = true;
			}
		}
	}

	if ($winner) {	
		if ($winning > 0) {
			echo "Laimejote: " . $winning;
		} else {
			echo "Taip sutampa, kad nieko nelaimejai";
		}
	} else {
		echo "Nebelosk";
	}


	// $time_elapsed_secs = microtime(true) - $start;
	// echo "\n" . $time_elapsed_secs;
}


function dices3($dices) {
	$game = [];
	for ($i=0; $i <$dices ; $i++) { 
		$game[] = rand(1, 6);
	}
	print_r($game);

	$winner = false;

	for ($i=0; $i < $dices-2 ; $i++) {
		for ($j = $i+1; $j < $dices-1 ; $j++) { 
			for ($k = $j+1; $k < $dices ; $k++) { 

				if ($game[$i] == $game[$j] && $game[$j] == $game[$k]) {
					echo "Winner";
					$winner = true;
					break 3;
				}
			}
		}
	}
}


function tempAbs() {
	$temperatures = [20, -6, 5,2, -15, -2];
	$nearestTempTo0 = array_shift($temperatures);

	foreach ($temperatures as $temp) {
		if (abs($temp) < abs($nearestTempTo0)) {
			$nearestTempTo0 = $temp;
		}
	}

	echo $nearestTempTo0;

}

function exam(string $username) {
	$users = [
		["user" => "Jonas", "mark" => rand(1,10)],
		["user" => "Petras", "mark" => rand(1,10)],
		["user" => "Tomas", "mark" => rand(1,10)],
		["user" => "Audrius", "mark" => rand(1,10)]
	]; 

	print_r($users);

	$curr_lowest = 0;

	foreach ($users as $user) {
		if ($user["user"] == $username) {
			$curr_lowest = $user["mark"];
			// unset($users[$user]);
			break;
		} 
	}	

	foreach ($users as $user) {
		if ($user["mark"] < $curr_lowest) {
			echo $user["user"] . " " .  $user["mark"] . "\n";
		} 
	}
}

$fileName = array_shift($argv);
$funcName = array_shift($argv);


call_user_func_array($funcName, $argv);

// print_r($argv);

