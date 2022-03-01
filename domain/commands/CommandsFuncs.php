<?php
namespace bvirk\commands;

/**
 * shell invocated print
 */


/*
 * shell print - could also have ben curl print - this becomes the output of curl
 * each line is prefixed $GLOBALS['printPrefix'], and if it has length each original line is surrounded by quotes 
 */
function p(...$ma) {
    foreach($ma as $m) {
        echo ($m === false ? "false\n" : ($m === true ? "true\n" : ($m === null ? "null\n" : 
            ( is_array($m) ? var_export($m,true)."\n" : $m."\n"))));
    }
}

function pNoIndentRecursive($arr) {
	if (is_array($arr)) 
		foreach ($arr as $item)
			if (is_array($item))
				pNoIndentRecursive($item);
			else
				p($item);
	else
		p($item);
}


function readlog($clearLog=false) {
    $fileName=LOGFILE;
    $content =  "no file content";
    if (file_exists($fileName)) {
        $content = file_get_contents($fileName);
        if ($clearLog)
            unlink($fileName);
    }
    return $content;
}    

function log(...$ma) {
    $ts = date("d H:i:s");
    foreach($ma as $m)
        file_put_contents (LOGFILE, $m === false 
            ? "$ts false\n" 
            : ($m === true 
            ? "$ts true\n" 
            : ($m === null 
            ? "$ts null\n"
            : ( $m === ''
            ? "$ts ''\n"  
            : ( is_array($m) 
            ? "$ts ".var_export($m,true)."\n" 
            : "$ts $m\n")))),FILE_APPEND);
}

/**
 * cnf can be used where a full namespace declarated name is expected as in callbacks in array 
 * map and filter.
 
 * @return current namespace prefixed argument
 */
function cns($var) { return __NAMESPACE__ . "\\" . $var; }


function scandirBesides($dir,$unWantedInDir) {
	return array_filter(scandir($dir),function($fn) use ($unWantedInDir) { return !in_array($fn,$unWantedInDir); });
}

function pagesPaths($pageArrWOE) {
	$retval = [];
	$pages = count($pageArrWOE) ? $pageArrWOE : pagesWOE();
	foreach ($pages as $pp)   
		if (file_exists(($mdDir=PAGESDIR."/".lcfirst($pp)))) 
			foreach (scandirBesides($mdDir,[".",".."]) as $mdFile) 
				$retval[$mdFile==="index.md" ? $pp : "$pp/".substr($mdFile,0,-3)] = "$pp/$mdFile";
		else
			$retval[$pp] = "$pp.php";
	return $retval;
}


trait CommandsFuncs {
}
