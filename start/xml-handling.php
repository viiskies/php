<?php 
//File handling
$file = fopen("menu.xml", "w") or die ("Unable to open a file!");
$data = fread($file, filesize("menu.xml"));
$data_array = simplexml_load_string($data);


fclose($data_array);