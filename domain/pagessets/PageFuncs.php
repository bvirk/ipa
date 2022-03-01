<?php
namespace bvirk\pagessets;
/*
function p(...$ma) {
    foreach($ma as $m)
        echo $m === false ? "false\n" : ($m === true ? "true\n" : ($m === null ? "null\n" : ( is_array($m) ? var_export($m,true) : "$m\n")));
}*/

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

function firstOf($str,$delimit) {
	$delimit = $delimit == '/' ? '\/' : $delimit;
	return preg_replace('/'.$delimit.'[^'.$delimit.']+$/','',$str);
}
function lastOf($str,$delimit) {
	return preg_replace('/^.+'.($delimit == '/' ? '\/' : $delimit).'/','',$str);
}

function loripsum() {
	?>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duo Reges: constructio interrete. Homines optimi non intellegunt totam rationem everti, si ita res se habeat. Huius ego nunc auctoritatem sequens idem faciam. </p>
	<p>Ut optime, secundum naturam affectum esse possit. Proclivi currit oratio. Quod idem cum vestri faciant, non satis magnam tribuunt inventoribus gratiam. Sed tamen enitar et, si minus multa mihi occurrent, non fugiam ista popularia. Dic in quovis conventu te omnia facere, ne doleas. Nam si propter voluptatem, quae est ista laus, quae possit e macello peti? </p>
	<p>Multa sunt dicta ab antiquis de contemnendis ac despiciendis rebus humanis; Me igitur ipsum ames oportet, non mea, si veri amici futuri sumus. Inde sermone vario sex illa a Dipylo stadia confecimus. Fortitudinis quaedam praecepta sunt ac paene leges, quae effeminari virum vetant in dolore. Quid, si reviviscant Platonis illi et deinceps qui eorum auditores fuerunt, et tecum ita loquantur? Ait enim se, si uratur, Quam hoc suave! dicturum. Propter nos enim illam, non propter eam nosmet ipsos diligimus. Haec bene dicuntur, nec ego repugno, sed inter sese ipsa pugnant. </p>
	<p>Nam ista vestra: Si gravis, brevis; Negat enim summo bono afferre incrementum diem. </p>
<?php }

function bailOut(...$ma) {
    header("Content-Type: text/plain;charset=UTF-8");
    $isNext=false;
    foreach ($ma as $m) {
        if (is_array($m) || is_object($m)) {
            if ($isNext)
                echo "-----------------------------------------------------------\n";
            var_dump($m);
        } else
            echo ($m === false ? "false" : ($m === true ? "true" : ($m === null ? "null" : ( $m === '' ? '\'\'' : $m))))."\n";
        $isNext = true;
    }
    exit();
}

function cns($clazz) { 
    return __namespace__."\\$clazz"; 
}
function htmlUl($list) {
	?><ul><?php
	foreach ($list as $li)
		echo "<li>$li</li>\n";
	?></ul><?php
}

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



function formatMessage(String $pattern, array $values) {
	return preg_replace_callback(
		'/\{\d}/'
    	,function($matches) use ($values) { $res=$values[substr($matches[0],1,1)]; return $res; }
    	, $pattern);
}

trait PageFuncs {
	function pieDecreaseLinear(array $slices, string $fmtText) : string{
		$sLen = count($slices);
		$del;
		$rest=1;
		for ($i=1; $i <=$sLen; $i++) { 
			//$del = $rest/(5.25-($sLen-3-$i)/4/$sLen);
			$del = $rest/($sLen/5-($sLen-3-$i)/4/$sLen);
			$rest -= $del;
			//$part=round(1000*$del)/10;
			$l[]=[$slices[$i-1],round(1000*$del)/10];
		}
		if ($rest > 0.03)
			$l[]=['unused',round($rest*1000)/10];
		
		$retval='';
		foreach (array_map(function($pair) use ($fmtText) { return formatMessage($fmtText,$pair); }, $l) as $htmlText)
			$retval .= "$htmlText\n";
		return $retval;
	}

}
