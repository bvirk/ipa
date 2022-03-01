<?php
require "funcs.php";

spl_autoload_register(function($classN) {
    require_once str_replace("\\","/",substr($classN,strpos($classN,"\\")+1)).".php"; 
});

if (!in_array($_GET['pe0'] ?? false,pagesWOE())) {
    header("Location: ".DEFAULTPAGE);
    exit();
}

$pe0 = in_array($_GET['pe0'] ?? false,pagesWOE()) ? $_GET['pe0'] : DEFAULTPAGE;
$pe = [ $pe0, $_GET['pe1'] ?? "index", $_GET['pe2'] ?? null,"bvirk\\pagessets\\".ucfirst($pe0)];
//header("Content-type: text/plain;charset=UTF-8");
//var_dump($pe);exit;

try {
	[new $pe[3](),$pe[1]]();
}
catch (Exception $ex) {
	showException($ex);
	exit(1);
}

