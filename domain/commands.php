<?php
require "funcs.php";

$printPrefix="";

spl_autoload_register(
	function ($classN) { 
		require_once str_replace("\\","/",substr($classN,strpos($classN,"\\")+1)).".php";
	} 
);

$classN = "bvirk\\commands\\".(file_exists(COMMANDDIR."/".(ucfirst($_GET['cmd'] ?? "")).".php")? ucfirst($_GET['cmd']) : "Help");
//var_dump($classN);
try {
	(new $classN())->run($_GET['parms'] ?? "");
	//$some="hello";
} 
catch (Exception $ex) {
	showException($ex);
	exit(1);
}



