<?php
namespace bvirk\pagessets;

function _logfilecontent() {
	if(file_exists(LOGFILE)) :
		?><h3>content of log</h3>
		<a href="/utils/clrLog">Clear log</a>
		<pre>
			<?="\n".str_replace(["<",">"],["&lt;","&gt;"],file_get_contents(LOGFILE)) ?>
		</pre><?php
	else : ?>
		<p>log is empty</p><?php
	endif;
}

function float300x250() {?>
	<div style="width: 300px; height: 250px;  float: left;"></div>
<?php }


class Utils extends PageAware {
	protected $jsFiles = [
			 "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"
			,"https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"];

	function log_it() {
		$this->stdPage(null,['_logfilecontent']); 
	}

	
	function clrLog() {
		global $pe;
		unlink(LOGFILE);
		$this->log_it();
	}
	
	function background() {
		$this->stdPage(['float300x250']);
		?>
		<img id="pic2" src="/img/pages/utils/ffrog124x200.png">
		<img id="pic3" src="/img/pages/utils/rpie.png">
		<img id="pic1" src="/img/pages/utils/b197x231oposity20.png">
		
		<script>
			<?php [JAVASCRIPT,'allImgDraggable'](); ?>
			$(function() { 
					$("a[title='bgcloser']").attr("onClick","$('div.sur').css('display','none');");
			});
		</script>
		
		<button id="mybut" onClick="bodyBGStyle();">css</button>
	<?php }
	

}

// <div class="lnk">sweaters <a href="#">&#8594;</a></div>
// circled dash x229d
// arrow right x2192

