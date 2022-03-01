
function bodyBGStyle() {
	let bgPos="background-position: ";
	let bgImg="background-image: ";
	let bgRep="background-repeat: ";
	$('img').each(function() { 
			let jsel = $('#'+$(this).attr("id"));
			['left','top'].forEach(function(p) { bgPos +=jsel.css(p)+" ";});
			bgPos += ", ";
			bgImg +="url("+jsel.attr("src")+"),";
			bgRep +="no-repeat,";
		});
	pnt("body {\n"
		+bgImg.slice(0,-1)+";\n"
		+bgPos.slice(0,-2)+";\n"
		+bgRep.slice(0,-1)+";\n}"
		);
}
