<?php
require "defines.php";

function pagesWOE() {
	return array_diff(array_map(function($x) { return lcfirst(substr($x,0,-4)); },
			array_filter(scandir(PAGESDIR),function($v) { return substr($v,-4) ===".php"; })),ISLIBRARYPAGES);
}

/**
 * invoke jedit regex error detection
 */
function showException(Exception $ex) {
	$trace = $ex->getTrace();
	echo "exception message: ". $ex->getMessage();
	foreach($trace as $s) 
		echo "Fatal error: caught or thrown: ".$s['class'].'->'.$s['function']." in ".$s['file'].":".$s['line']."\n";
	exit(1);
}
