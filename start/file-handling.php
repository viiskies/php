<?php 
$file = fopen("customers.csv", "r") or die ("Unable to open a file!");
$fileW = fopen("email.csv", "w") or die ("Unable to open a file!");

for ($i=1; !feof($file); $i++) { 
	$customer = explode(",", fgets($file));
	fwrite($fileW, $i . "," . $customer[0] . "@php.lt," . $customer[1]);
}

fclose($file);
fclose($fileW);