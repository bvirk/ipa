function p(arg) {
	console.log(arg);
}

function htmlEncode(input) {
	return input
    	.replace(/&/g, '&amp;')
    	.replace(/</g, '&lt;')
    	.replace(/>/g, '&gt;')
    	.replace(/\n/g, '<br>')
    	.replace(/\\n/g, '<br>')
    	.replace(/\t/g, '&nbsp;&nbsp;')
    	.replace(/\\t/g, '&nbsp;&nbsp;');
    	
}

function formatMessage(fmtStr, values) {
	return fmtStr
		.replaceAll(/\{\d\}/g,i => values[i.substring(1,2)])
		.replaceAll(/\\n/g,"\n")
		.replaceAll(/\\t/g,"\t");
}

function formatMessage1(fmtStr, values) {
	return fmtStr+"<br>";
}



function bpressed() {
		let tab = window.open('about:blank', '_blank');
		//let numInput=$("fieldset p").length;
		//for (let i=0; i < numInput; i++)
		//	tab.document.write($("#slidid"+i).val()    +": "+$("#slider"+i).val()+"<br>");
		//tab.document.write(<?= "'$this->thatAll'" ?>)
		//let employees = [{ "id": 1, "name": "kiran" }, { "id": 2,"name": "franc"}];
		//console.table(employees);  
		
		let fmt=$("#format").val();
		tab.document.write(htmlEncode($("#header").val()));
		parts().forEach(function (profile, index, arr) 
			{ tab.document.write(htmlEncode(formatMessage(fmt,profile))+"<br>"); });
		tab.document.write(htmlEncode($("#footer").val()));
		
		tab.document.close();

}
	
	
	
function parts() {
		let arr=[];
		let numInput=$("#fieldset p").length;
		let procent=parseInt($("#procent").val());
		//console.log("numInput,procent: "+numInput+","+procent);
		let sum=0;
		for (let i=0; i < numInput; i++) {
			part = $("#slider"+i).val();
			//p("part,sum: "+part+","+sum);
			sum +=parseInt($("#slider"+i).val());
		}
		//console.log("sum after loop: "+sum);
		for (let i=0; i < numInput; i++) {
			let partval=parseInt($("#slider"+i).val())*procent/sum;
			//console.log("partval: "+partval);
			arr.push([$("#slidid"+i).val(),partval.toFixed(1)] );
		}
		return arr;
}

function setFormat(fmtStr) { 
	$("#format").val(fmtStr);
}

function play() {
		//console.log(parts());
		let fmt=$("#format").val();
		parts().forEach(function (profile, index, arr) 
			{ p(formatMessage(fmt,profile)); });
}

/*
$(document).ready(function() {
	

	for (let ix=0; ix < pp.length; ix++)
		$("#forSlider"+ix).text(pp[ix]);
});*/
