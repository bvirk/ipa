<?php
namespace bvirk\pagessets;

use bvirk\utilclasses\Parsedown;

function hamMenu($color="") {
	global $pe;
	$style = $color ? "style='color: $color;'"  : '';
	?><a href=<?= "'/sitemap/index/$pe[0]:$pe[1]' $style" ?> class="ham-menu">&#8801;</a><?php
}
	



class PageAware {
    use PageFuncs;
    private $htmlGenObj;
    //private $preIncClassNum=-1;
    protected $jsFiles = [];
    protected $cssFiles = [];
    protected $jsAsMethods = [];
    

    function __construct() {
    	global $pe;
    	$this->htmlFirst();
        if (file_exists(__DIR__.strtolower("/$pe[0]/$pe[1].md")))
        	$this->htmlGenObj = $this->htmlGen();
    }
    
    function __destruct() {
        $this->htmlLast();
    }
    
    function htmlGen() {
    	global $pe;
        foreach(include(__DIR__.strtolower("/$pe[0]/$pe[1].md")) as $mdSrc)
        	yield (new Parsedown())->text($mdSrc);
    }
    
    /**
     * Get next html snippet
     */
    function nexthtml() {
    	$html = $this->htmlGenObj->current();
    	$this->htmlGenObj->next();
    	return $html;
    }
    
    function __call($notUsed,$notPermitted) {
        global $pe;
        if (count($notPermitted))
        	throw new \Exception("not allowed here");
        if (is_object($this->htmlGenObj)) {
			//while ($this->htmlGenObj->valid())
			//	$this->nextDiv();
			$this->stdPage();
		} else { ?>
			<script>window.location ="<?= DEFAULTPAGE ?>";</script><?php 
		}
    }
    
	/**
	 * html div element surrounded list af html snippets
	 * @param $num is number of snippet returned
	 * @param $givenClassIndex makes et possible to start div element class index at an other number than snippet index.
     **/
    function nextDiv(int $num=1, $divClassAttStartIndex=null) {
    	global $pe;
    	static $index = -1;
    	while ($num--) :
    		$index = $divClassAttStartIndex ?? ++$index;
	    	$divClassAttStartIndex=null;
			?><div <?= "class=\"mdsur-$pe[0]-$pe[1]-$index\"" ?> >
			<?= $this->nexthtml() ?>
			</div>
		<?php endwhile;
	}

	function htmlFirst() {
        global $pe;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/common.css">
    <?php if (file_exists("css/$pe[0].css")): ?>
    	<link rel="stylesheet" type="text/css" href="/css/<?= "$pe[0]" ?>.css">
    <?php endif; 
    echo "<!-- done testing for existing of css/$pe[0].css -->\n"; 
    if (file_exists("css/$pe[0]/$pe[1].css")): ?>
    	<link rel="stylesheet" type="text/css" href="/css/<?= "$pe[0]/$pe[1]" ?>.css">
    <?php endif; 
	foreach($this->cssFiles as $cssFile)  
		echo "<link href='$cssFile' rel='stylesheet' type='text/css'>\n";
	foreach($this->jsFiles as $jsFile)  
		echo "<script src=\"$jsFile\" ></script>\n";
    ?><script src="/js/common.js"></script><?php
    if (file_exists("js/$pe[0].js")):  ?>
        <script src="/js/<?= $pe[0] ?>.js"></script>
    <?php endif; 
    if (file_exists("js/$pe[0]/$pe[1].js")):  ?>
    	<script src="/js/<?= $pe[0].'/'.$pe[1] ?>.js"></script>
    <?php endif; 
    if (count($this->jsAsMethods)): 
    	?><script><?php
    	foreach($this->jsAsMethods as $jsSnip) 	
    		[JAVASCRIPT,$jsSnip]();

    	?></script>
    <?php endif;
    ?> 
    <title><?= $this->title ?? "$pe[0]-$pe[1]" ?></title>
    </head>
    <body>
    <?php }
    
    function htmlLast() { ?>
    	</body></html>
    <?php }
    
    protected function allSitemapLinks() {
    	$pagesSet = array_map(function($d) { return lcfirst(preg_replace('/\.[^\.]+$/','',$d)); } 
    		,array_filter(array_diff(scandir(__DIR__), ['PageFuncs.php','PageAware.php','Sitemap.php','Landing.php','.','..']),
    		function($d) { return preg_match('/\.php/',$d);} ));
    	$addrAble=$pagesSet;
    	foreach ($pagesSet as $pages) { 
    		$mdDir = __DIR__."/$pages";
    		$mdFiles = !file_exists($mdDir) ? [] : 
    		array_map(function($d) use($pages) { return "$pages/".preg_replace('/\.[^\.]+$/','',$d); } 
    		,array_diff(scandir($mdDir), ['.','..','index.md']));
    		$addrAble = array_merge($addrAble,$mdFiles);
    		if (property_exists(cns(ucfirst($pages)),'methods')) {
    			$addrAble = array_merge(
    				$addrAble
    				,array_map(function ($m) use ($pages) { return "$pages/$m";},cns(ucfirst($pages))::$methods));
    		}
    	}
    	sort($addrAble);
   		//log($addrAble);
    	return $addrAble;
    }
    
    function methodLinks(String $ulId=null)  {
    	global $pe;
    	$reflector = new \ReflectionClass(get_class($this));
		foreach($reflector->getMethods() as $property)	{
			$name = $property->getName();
			$doc = $reflector->getMethod($name)->getDocComment(); 
			if (strpos($doc, "/** lt" ) === 0)
				$links[] = '<a href="/' .$pe[0].'/'.$name. '">'. trim(str_replace("*/","",str_replace("/** lt","",$doc))) . "</a>";
		}
		return $ulId ? '<ul id="'.$ulId. '"><li>'.implode("</li><li>",$links).'</li></ul>': $links;
	}
	
	function webProfilePage($surFirst=null,$surLast=null) { ?>
		<a href="\landing" class="logo"><img src="/img/pages/b85x100FrilagtOil.png"></a>
		<?= $this->stdPage($surFirst,$surLast) ?>
		<div class="contactOpt">
			<div class="mailPic"></div>
			<span class="phone" ><a href="tel:28569086">&#128222</a></span>
			<span class="mail">@</span>
			<span class="github"><a href="https://github.com/bvirk"><img src="/img/pages/github32.png"></a></span>
		</div>
		<?php
	}
	
	function stdPage($surFirst=null,$surLast=null) { 
		hamMenu();
		?> 
		<div class="sur">
		<?php 
		callFunc($surFirst);
		if (is_object($this->htmlGenObj))
			while ($this->htmlGenObj->valid())
				$this->nextDiv(); 
		callFunc($surLast);?>
		</div><?php
	}

}