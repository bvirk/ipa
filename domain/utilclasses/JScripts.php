<?php
namespace bvirk\utilclasses;

class JScripts {
	
	static function allImgDraggable() { ?>
		$( function() {
			let zindex=9;
			$('img').each(function() { 
				let sel = $('#'+$(this).attr("id"));
				sel.css({'position':'absolute','top':'0','left':'0'});
				sel.css("z-index",zindex);
				zindex -= zindex > 1 ? 1 : 0; 
				sel.draggable();
			});	
		});
	<?php }
		
	static function expandMenu() { 
    	global $pe;
    	$main = \bvirk\pagessets\firstOf($pe[2],':');
    	if (!in_array($main,["",null,DEFAULTPAGE])) :	
    	?>
    	$( function() {
    		toogleMenu(<?="'$main'" ?>);
    	});
    <?php endif; }
 	static function attachHashNumLinksOnReady() { 
    	global $pe ?>
    	$( function() {
    		attachHashNumLinks(<?="'$pe[0]','$pe[1]'"?>);
    	});
    <?php }
    static function jsFocusOnReload() { ?> 
		var blured=false;
		window.onblur = (() => { setTimeout(() => blured=true,2000)});
		window.onfocus = (() =>  {
		  if (blured) {
			blured=false;
			window.location.reload(true);
			}});
    <?php }
}