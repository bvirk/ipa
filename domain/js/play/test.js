function p(...mes) {
	mes.forEach(arg => {
		if (Array.isArray(arg))
			arg.forEach(aArg => p(aArg));
		else {
			if (arg === null)
				arg="null";
			if (typeof arg === "undefinded")
				arg="undefinded";
			if (typeof arg === "string" && arg.length == 0)
				arg='""';
			
			let lines = ""+$('#myConsole').text();
			if (lines.length > 0)
				$('#myConsole').text(lines+"\n"+arg);
			else
				$('#myConsole').text(arg);
		}
		});  
	//$('#myConsole').text(mes);
}
function testitpressed() {}
$(function() {
p("kort korte starkt");
});


