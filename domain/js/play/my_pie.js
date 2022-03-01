$(function () {
	var chartype = {
		type: 'pie'
	}
	var chartitle = {
		text: ''
	}
	var charsubtitle = {
		text: 'Click the slices to view versions. Source: netmarketshare.com.'
	}
	var chartooltip = {
		headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
		pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
	}
	var chartplotoptions = {
		series: {
			dataLabels: {
				enabled: true,
				format: '{point.name}: {point.y:.1f}%'
			}
		}
	}
	var chartseries = [{
		name: 'Aktivitet',
		colorByPoint: true,
		data: [{
			  name: 'Social and legal communication',
			  y: 2.0,
			  drilldown: 'Social and legal communication'
			}
			,{
			  name: 'News and knowledge',
			  y: 24.4,
			  drilldown: 'News and knowledge'
			}
			,{
			  name: 'Manage data',
			  y: 17.5,
			  drilldown: 'Manage data'
			}
			,{
			  name: 'Programming',
			  y: 18.7,
			  drilldown: 'Programming'
			}
			,{
			  name: 'Graphics and photo editing',
			  y: 12.5,
			  drilldown: 'Graphics and photo editing'
			}
			,{
			  name: 'Video and sound',
			  y: 24.9,
			  drilldown: 'Video and sound'
			}]
	}]
	var chartdrilldown = {
		series: [{
			name: 'Social and legal communication',
			id: 'Social and legal communication',
			data: [
			  ['sms, email and legal affairs',0.4],
			  ['debate i forums',0.3],
			  ['trade',0.3],
			  ['accounting',0.4],
			  ['private domain',0.5]
			]},{
			name: 'News and knowledge',
			id: 'News and knowledge',
			data: [
			   ['wikipedia',4.0]
			  ,['search engines',4.2]
			  ,['dr.dk',3.0]
			  ,['RSS-feeds',5.8]
			  ,['podcasts',6.1]
			]},{
			name: 'Manage data',
			id: 'Manage data',
			data: [
			   ['arange files i dirs',5.7]
			  ,['archive, edit and delete',5.8]
			  ,['database usage',3.7]
			  ,['backup',1.7]
			  ,['git',2.0]
			]},{
			name: 'Programming',
			id: 'Programming',
			data: [
			   ['c og c++',0.6]
			  ,['java',2.6]
			  ,['html, css and javascript',2.8]
			  ,['ms-access vba ide',1.3]
			  ,['php phpmyadmin',2.6]
			  ,['asp',0.4]
			  ,['bash in linux',2.5]
			  ,['bat in windows',0.3]
			  ,['ruby',0.2]
			  ,['jedit and vi',2.8]
			  ,['mbed.com',0.8]
			  ,['arduino',1.2]
			]},{
			name: 'Graphics and photo editing',
			id: 'Graphics and photo editing',
			data: [
			   ['sketchup',4.6]
			  ,['photoshop',3.4]
			  ,['gimp',5.0]
			]},{
			name: 'Video and sound',
			id: 'Video and sound',
			data: [
			   ['ffmpeg',4.3]
			  ,['youtube-dl',5.2]
			  ,['mplayer',5.8]
			  ,['celluoid',6.6]
			]}
		]
	}
	$('#container').highcharts({
		chart:chartype,
		title: chartitle,
		tooltip: chartooltip,
		plotOptions: chartplotoptions,
		series: chartseries,
		drilldown:chartdrilldown
	});
	
});