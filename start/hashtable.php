<?php

$row = 5;
$column = 15;
$symbol = '#';


echo "\n";
for ($i=0; $i < $row; $i++) {
	echo "    ";

	for ($j=0; $j < $column; $j++) { 
		echo $symbol;
	}
	echo "\n";
}