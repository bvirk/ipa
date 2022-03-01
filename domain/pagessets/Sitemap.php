<?php
namespace bvirk\pagessets;

function docroot_file_exists($fileN) {
	return file_exists($_SERVER['DOCUMENT_ROOT'].'/'.preg_replace('%^/%','',$fileN));
}

class Sitemap extends PageAware {
	protected $jsFiles = [
			 "/js/jquery-3.6.0.min.js"
			];
	protected $jsAsMethods = ["expandMenu"];
	
	
	function index() {
    	global $pe;
    	$backLink = "/".str_replace(":","/",$pe[2]);
    	?><div class="sitemap"><div class="topOfMenu">
    	<a href= <?= "'$backLink'" ?> class="back-to-ham">&#x2715;</a>
    	<?php  if (substr($backLink,0,strlen(DEFAULTPAGE)) != DEFAULTPAGE) 
    		echo "<a href='".DEFAULTPAGE."' class='menu-root'>&#8962;</a>\n";
    	?></div><?php
    	foreach ($this->allSitemapLinks() as $l): 
            $isMain = strpos($l,"/") === false;
            $pMethod = $isMain ? $l : lastOf($l,"/");
            $pClass = firstOf($l,'/');
            $imageSrc = $isMain ?  "/img/pages/$pClass/menu.jpg" : "/img/pages/$pClass/".strtolower($pMethod).".jpg";
            //log($imageSrc . (docroot_file_exists($imageSrc) ? " exists" : " dont exists"));
            if (!docroot_file_exists($imageSrc))
            	$imageSrc = "/img/pages/menu.jpg";
            
        	?><div class=<?= "'".($isMain ? "main-" : "submenu-")."$pClass'" ?>>
        	<a href="<?="/$l"?>">
        		<img src=<?="'$imageSrc'"?>>
        	</a>
        	<?php if ($isMain) :
        		?><a href="#" class=<?="'main-$l'"?> onClick=<?="'toogleMenu(\"".$l."\");'" ?>>&#x2192;</a>
        	<?php endif;?>
        	<div class='linktext'><?=str_replace('_',' ',$pMethod)?></div>
        	</div>
         <?php endforeach;
         ?></div><?php
    }

    function mdsrc() {
		global $pe;
		$pe2 = explode('-',$pe[2]);
		$fileN = __DIR__."/".str_replace(":","/",$pe2[0]).".md";
		?><div class="mdSource"><?= "Content of file: ". substr($fileN,strlen($_SERVER['DOCUMENT_ROOT'])) ?>
		<a href= "/<?= str_replace(":","/",$pe2[1]) ?>" class="mdsrc">&#x2715;</a></div><?php
		if (file_exists($fileN)) 
			echo "<pre>\n".str_replace(["<",">"],["&lt;","&gt;"],file_get_contents($fileN))."\n</pre>\n";
		else
			echo "<p>\nFile:"."$fileN don't exists</p>\n";
	}
}

