<?php
$my_file = fopen("customers.csv", "r") or die ("unable to open file");
$my_file2 = fopen("email.csv", "w") or die ("unable to open file");
for ($id = 1; !feof($my_file); $id++) {
    $customers = explode(",", fgets($my_file));
    // $write = $id . "." . $customers[0] . ", " . rtrim($customers[1],"\n") . ", " . $customers[0] . "@php.lt \n";
    $write = $id . "," . $customers[1] . "," . $customers[0] . "@phpasfdhjk.lt,";
    fwrite($my_file2, $write);
    // echo $write;
}
fclose($my_file);
fclose($my_file2);