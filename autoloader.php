<?php

$file_list = [];
function file_search($extension) {
	global $file_list;
	$length = strlen($extension) * -1;

	$items = glob("*", GLOB_MARK);
	foreach ($items as $item) {
		if (substr($item, -1) === '/') {
			chdir($item);
			file_search($extension);
		} else if (substr($item, $length) === $extension) {
			array_push($file_list, getcwd() . '/' . $item);
		}
	}
	chdir("../");
}

file_search(".php");

foreach ($file_list as $file) {
	var_dump($file);
	include_once $file;
}