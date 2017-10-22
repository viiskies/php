<?php

function get_random_numbers_list(int $min = 1, int $max = 75, int $quant = 75) {
	$randomList = [];
	while (count($randomList) < $quant) {
		$randNum = rand($min, $max);
		if (!(in_array($randNum, $randomList))) {
			array_push($randomList, $randNum);
		}
	}
	return $randomList;
}

$luckyNumbers = get_random_numbers_list();

function get_ticket() {
	$ticketNumbers = [];
	for ($i = 1; $i < 75 ; $i += 15) { 
		array_push($ticketNumbers, get_random_numbers_list($i, $i + 15, 5));
	}
	return $ticketNumbers;
}

$ticket = get_ticket();

function four_corners($tick) {
	if (in_array($tick[0][0], array_slice($luckyNumbers, 0, 40))) {
		echo "win";
	}
}

four_corners($ticket);