<?php 
date_default_timezone_set('Europe/Vilnius');

function custom_error($error_level, $error_message, $error_file, $error_line, $error_context) {
	$text = '';
	$text .= date("Y-m-d H:i:s") . ",";
	$text .= $error_file . " @ line: " . $error_line . ",";
	$text .= $error_message . "\n";
	$fileW = fopen("error.log", "a") or die ("Unable to open a file!");
	fwrite($fileW, $text);
	fclose($fileW);
}

set_error_handler("custom_error");

echo $a;

// $skaicius = 5;

// if ($skaicius < 1) {
// 	echo "OK!";
// } else {
// 	throw new Exception("Klaida!");
// }

// function check_num($number) {
// 	if ($number > 1) {
// 		throw new Exception('Value must be 1 or below');
// 	}
// 	return true;
// }

// try {
// 	$file = fopen("no")
// } catch (Exception $e) {
// 	echo 'Message: ' . $e->getMessage() . "\n";
// }

// echo "continuing...";