<?php
namespace bvirk\commands;

/**
 * Used to make functions and method parameters, for making snippet parameters parameterable
 * 
 * @param $funcWP mean function with potential parameters and is an array containing the name of a function or
 * method and possible parameters to that. It can have an value of null instead for flexibility in use of no operation 
 * Interpreting falls in two groups:
 * 	1. first itm is the name of a function in current namespace and possible futher arguments is parameters. 
 * 	Only one parameter besides function name is a simple type otherwise an array
 * 	2. first item is an object and second method name. $funcWP has at least 2 item in array
 * 		futher items is argument as for in 1.
 * 	If no parameters is present, the function or method is called without any parameters - IOW an e.g. foo()  
**/
function callFunc($funcWP=null) {
	if ($funcWP) {
		if (is_object($funcWP[0]))
			if (count($funcWP) == 2)
				([$funcWP[0],$funcWP[1]])();
			else {
				if (count($funcWP) > 2 ) {
					$args = array_slice($funcWP,2,count($funcWP)-2);
					([$funcWP[0],$funcWP[1]])(count($args) == 1 ? $args[0] : $args);
				}
			}
		else {
			if (count($funcWP) == 1)
				(cns($funcWP[0]))();
			else {
				$args = array_slice($funcWP,1,count($funcWP)-1);
				(cns($funcWP[0]))(count($args) == 1 ? $args[0] : $args);
			}
		}
	}
}

function endsWithPhp($str) {
		return substr($str,-4) ===".php";
	}

function  calledwd($some=false) {
	$nw = $some ? $some : ["c","v"];
	p($nw);
}

function firstOf($str,$delimit) {
	$delimit = $delimit == '/' ? '\/' : $delimit;
	return preg_replace('/'.$delimit.'[^'.$delimit.']+$/','',$str);
}
function lastOf($str,$delimit) {
	return preg_replace('/^.+'.($delimit == '/' ? '\/' : $delimit).'/','',$str);
}


/**
 * format a string containing {n} interpolation places with that of $values 	 
 *
 * @param $pattern
 * @param $values
 * @return 
 */
function formatMessage(String $pattern, array $values) {
	return preg_replace_callback(
		'/\{\d}/'
    	,function($matches) use ($values) { $res=$values[substr($matches[0],1,1)]; return $res; }
    	, $pattern);
}
function pieDecreaseLinear(array $slices, string $fmtText): array {
	p($fmtText);
	$sLen = count($slices);
	$del;
	$rest=1;
	for ($i=1; $i <=$sLen; $i++) { 
		$del = $rest/(5.25-($sLen-3-$i)/4/$sLen);
		$rest -= $del;
		$part=round(1000*$del)/10;
		$l[]=[$slices[$i-1],$part];
	}
		
	return array_map(function($pair) use ($fmtText) { return formatMessage($fmtText,$pair); }, $l);
}

	
class Play extends CommandsBase {
    use CommandsFuncs;
    
    private $stack;
    private $mdList;
    
    function __call($method,$mustBeEmpty) {
    	p($method);
    	if (count($mustBeEmpty)) {
    		throw new \Exception("unimplemented argument\n");
    	}
    }
    
    function classAttCounter($givenIndex=null) {
		static $index = -1;
		return $index = $givenIndex ?? ++$index;
	}

    
    function run($args) {
    	$test = ""; 
    	p($test ? "empty is true" : "empty is false" );
    }
    
			
	
	function callFunc($funcWP=null) {
		if ($funcWP) {
			if (is_object($funcWP[0]))
				if (count($funcWP) == 2)
					([$funcWP[0],$funcWP[1]])();
				else {
					if (count($funcWP) > 2 ) {
						$args = array_slice($funcWP,2,count($funcWP)-2);
						([$funcWP[0],$funcWP[1]])(count($args) == 1 ? $args[0] : $args);
					}
				}
			else {
				if (count($funcWP) == 1)
					(cns($funcWP[0]))();
				else {
					$args = array_slice($funcWP,1,count($funcWP)-1);
					(cns($funcWP[0]))(count($args) == 1 ? $args[0] : $args);
				}
			}
		}
	}
    
	
}
