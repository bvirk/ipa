/**
 * _P_rint _M_essage in _N_ew _T_ab
 * unformated text - use newline and not <br> in messag
 */
function pnt(mes) { 
	let tab = window.open('about:blank', '_blank');
	tab.document.write("<pre>\n"+mes+"\n</pre>");
	tab.document.close();
}



function toogleMenu(selTrail) {
	let sel= $('a.main-'+selTrail);
	let closed='\u2192';
	let open='\u229d';
	let display='';
	if (sel.text() === closed) {
		sel.text(open);
		display='block';
	} else {
		sel.text(closed);
		display="none";
	}
	$('div.submenu-'+selTrail).css("display",display);
	//alert('atext,open,atextlen= '+atext+","+closed+","+atext.length);
}



/**
 * change property background-image of selector imageSelector to imageUrlFunc 
 * on hover on hoverSelector and back to the original value of property
 * on that hover's ending.
**/
var backgroundImageHoverOn = function(hoverSelector, imageSelector, imageUrlFunc) {
	let origImage= $(imageSelector).css('backgroundImage');
	$(hoverSelector).hover(
		 function (){ 
		 	 $(imageSelector).css("backgroundImage", imageUrlFunc);
		 }
		,function (){
			$(imageSelector).css("backgroundImage", origImage);
		}
	);
};


/**
 * Attaches onClik methodcall: displayBlock(selector) to  to links which href is a
 * hash sign prefixed number - eg. #3.
 * It as all links in page pe0/pe1 that is affected. The selectors is:
 * 'div-mdsur-pe0-pe1-num' where num is a number. Method displayNone is called for
 * each selecter, ensuring display:block and border css properties
 */
function attachHashNumLinks(pe0,pe1) {
	$("a[href*=\\#").each(function( index ) {
		let href=$(this).attr("href");
		if (href.match(/^#\d+$/)) {
			let selector="div.mdsur-"+pe0+"-"+pe1+"-"+href.substr(1);
			$("a[href=\\"+href).attr("onClick","displayBlock('"+selector+"');");
			displayNone(selector);
		}
	});
}

/**
 * Initial border and hidden
 */
function displayNone(selector) {
	let sel = $(selector)
	sel.css("display","none");
	sel.css("border","2px solid lightgrey");
}

/**
 * Display block and initial close button with onClick call of method displayNone.
 * On following call with same selector no new button added as it already exists.
 */
function displayBlock(selector) {
	let sel = $(selector);
	let num=selector.replace(/^.+-/,"");
	if (sel.css("display") === "block") {
		displayNone(selector);
		return;
	}
	sel.css("display","block");
	let cur = sel.html();
	if (!cur.match(/<button/)) {
		sel.html("<button class='"+num+"'>close</button>"+cur);//>
		$("button."+num).attr("onClick","displayNone('"+selector+"');").css("float","right"); 
	}
}


this.screenshotPreview = function(xOffset,yOffset){	
	/* CONFIG */
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result
		
	/* END CONFIG */
	$("a.screenshot").hover(function(e){
		this.t = this.title;
		this.title = "";	
		var c = (this.t != "") ? "<br/>" + this.t : "";
		$("body").append("<p id='screenshot'><img src='"+ this.rel +"' alt='url preview' />"+ c +"</p>");								 
		$("#screenshot")
			.css("top",(e.pageY - yOffset) + "px")
			.css("left",(e.pageX + xOffset) + "px")
			.fadeIn("fast");						
    },
	function(){
		this.title = this.t;	
		$("#screenshot").remove();
    });	
	$("a.screenshot").mousemove(function(e){
		$("#screenshot")
			.css("top",(e.pageY - yOffset) + "px")
			.css("left",(e.pageX + xOffset) + "px");
	});			
};

//$(function(){
//	screenshotPreview(1,250);
//});

