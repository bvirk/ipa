<?php
namespace bvirk\pagessets;

function _dir() {
	global $pe;
	$str= $pe[2] ? "./".str_replace('_','/',$pe[2])."/" : "./";
	echo "<p>Directory in Document Root: " .preg_replace('%/$%','',substr($str,1)). "</p>\n";
	?><ul><?php
	echo "<li><a class='back' href='/$pe[0]/$pe[1]'>.</a></li>\n";
	foreach(array_diff(scandir($str),['.','..']) as $fn) {
		$appr = is_dir($str.$fn) 
			? "<a href='/$pe[0]/$pe[1]/".str_replace('/','_',substr($str,2))."$fn' >$fn</a>"
			: $str.$fn; //substr($str.$fn,1);
		echo "<li>$appr</li>\n";
		if (in_array(substr($fn,-4,4),[".jpg",".png"]))
			echo "<img src='".substr($str.$fn,1)."'><hr>\n";
		}
	?></ul><?php
}



	

class Play extends PageAware {
	protected $jsFiles = [
			 "/js/jquery-3.6.0.min.js"
			,"/js/jquery-ui.min.js"
			,"/js/highcharts.src.js"
			,"https://code.highcharts.com/modules/drilldown.js"
			,"/js/jquery.highchartTable.js"
			];
	protected $cssFiles=['https://fonts.googleapis.com/css?family=Rock+Salt'];
	static $methods = ['web_directory','my_pie','slider','pie_art'];
	
	
	function web_directory() {
		$this->stdPage(null,['_dir']);
	}
	
	function pie_art() { 
		hamMenu('white');?>
		<a href="/play/my_pie">
			<div class="big"> </div>
		</a>
	<?php }
	
	
	function foo_bar() {
		global $pe;
		?><pre><?php
		echo var_export($pe,true)."\n";
		?></pre><?php
	}
	
	function my_pie() { 
		hamMenu('white');
		?>
		<div id="container" ></div>
    <?php }
    
    function test() {
		hamMenu();?>
    	<h3>javascript test area</h3>
    	<textarea id="myConsole" rows="30" cols="80"></textarea>
    	<?php 
    }
   
    function slider() {
		hamMenu();
    	global $pe;
		$cat = ['top','soc','news','admin','programming','draw','video'];
		$subcat = $pe[2] ?? $cat[0];
		
		$defV = [$cat[0] => [[
				 "social og juridisk kommunikation"
				,"viden og nyheder"
				,"administrere og strukturere data"
				,"programmere"
				,"tegne og foto redigering"
				,"video og lyd"
				],100,null]
				,$cat[1] => [[	
				 "sms, email og nemid"
				,"debatere i fora"
				,"køb og salg"
				,"regnskab"
				,"eget domæne"
				],2.8,0]
				,$cat[2] => [[
				 "wikipedia"
				,"search engines"
				,"dr.dk"
				,"RSS-feeds"
				,"podcasts"
				],23.3,1]
				,$cat[3] => [[
				 "flytte filer i mapper"
				,"hente, ændre og slette filer"
				,"database brug"
				,"backup"
				,"git"
				],19.3,2]
				,$cat[4] => [[
				 "c og c++"
				,"java"
				,"html, css and javascript"
				,"ms-access vba ide"
				,"php phpmyadmin"
				,"asp"
				,"bash in linux"
				,"bat in windows"
				,"ruby"
				,"jedit and vi"
				,"mbed.com"
				,"arduino"
				],18.1,3]
				,$cat[5] => [[
				 "sketchup"
				,"photoshop"
				,"gimp"
				],13.7,4]
				,$cat[6] => [[
				 "ffmpeg"
				,"youtube-dl"
				,"mplayer"
				,"celluoid"
				],22.8,5]
			];
		$headerIX = $defV[$subcat][2];
		$headerValname = $headerIX !== null ?  $defV[$cat[0]][0][$headerIX] : "";
		$headerVal = $headerIX !== null ? ",{\\nname: '$headerValname',\\nid: '$headerValname',\\ndata: [\\n":""; 
		$footerVal = $headerIX !== null ? "]}" : "";
		?>
		<fieldset id="fieldset">
		<?php
			foreach ($defV[$subcat][0] as $ix => $value) : ?>
		  <p id= <?="'part$ix'" ?> >
		    <input type="text" id=<?= "'slidid$ix'" ?> name=<?= "'slidname$ix'" ?>  value=<?= "'$value'" ?> width="25" />
		    <input type="range" id=<?= "'slider$ix'" ?> min="0" max="100" value="50" />
		  </p>
		  	<?php endforeach; ?>
		</fieldset><br>
		<fieldset>
			<p>preconfigured format strings</p>
			<button onclick="setFormat('{0} has the share {1} of the pie.')">{0} has the share {1} of the pie.</button><br>
			<button title="drilldown pie, inner-" onclick="setFormat('\\t,[{0},{1}]\\n')">\t,[{0},{1}]\n</button><br>
			<button title="drilldown pie, outer-" onclick="setFormat(',{\\n\\tname: {0}\\n\\t,y: {1}\\n\\t,drilldown: {0}\\n}')">,{\n\tname: {0}\n\t,y: {1}\n\t,drilldown: {0}\n}</button><br>
			<button title="pie" onclick="let fmtstr = '<tr>\\n\\t<td>{0}</td>\\n\\t<td data-graph-name={0}>{1}</td>\\n</tr>';setFormat(fmtstr);" >&lt;tr&gt;\n\t&lt;td&gt;{0}&lt;/td&gt;\n\t&lt;td data-graph-name={0}&gt;{1}&lt;/td&gt;\n    &lt;/tr&gt;</button><br>
		</fieldset><br>
		
		<label id="forprocent" for="procent">procent</label>
		<input type="number" value=<?= "'".$defV[$subcat][1]."'" ?> id="procent"/><br>
		
		<label id="forheader" for="header">header</label>
		<input title="header for list of 'records'" type="text" value=<?='"'.$headerVal.'"'?> id="header" size="100"/><br>
		
		<label id="forfooter" for="footer">footer</label>
		<input title="footer for list of 'records'" type="text" value=<?="'$footerVal'"?> id="footer" size="100"/><br>
		
		<label id="forformat" for="format">format</label>
		<input title="add double quotes manually" type="text" value="[0]-[1]" id="format" size="100"/><br>
		
		<button id="myButton" onclick="bpressed()" >export</button>
		
		<?php
		
	}
	
	/** lt nextdiv do */
	function nextdiv_args() {
		hamMenu();
		echo "\n\n<!-- THIS SHOWS HOW PARAMETERS TO nextDiv() AFFECT CLASS ATTRIBUTE OF div\n\$this->nextDiv(4,2) -->\n";
		$this->nextDiv(4,2);
		echo "\n\n<!-- \$this->nextDiv().-->\n";
		$this->nextDiv();
		echo "\n\n<!-- \$this->nextDiv(2,2) -->\n";
		$this->nextDiv(2,2);
	}
	
    
}



