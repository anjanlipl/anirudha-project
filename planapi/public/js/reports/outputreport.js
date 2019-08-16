$( document ).ready(function() {
	$('.seeReport').click(function(){
		var schemeId= $('#report_scheme_id').val();
			var reportUrl= location.href+'/'+schemeId;
			 $.ajax({url: reportUrl,method:'get', success: function(result){
        console.log(result[0].total);


        var chart1 = new CanvasJS.Chart("barchartContainer", {
		title:{
			text: "output Indicators Bar chart"              
		},
		data: [              
		{
			// Change type to "doughnut", "line", "splineArea", etc.
			type: "stackedColumn",
			dataPoints: [
				{ label: "Target Acheived",  y: result[0].ontrack ,color: "green" },
				{ label: "Delayed", y: result[0].offtrack ,color: "red"},
				{ label: "In Progress", y: result[0].inProgress ,color: "yellow" },
				{ label: "NA", y: result[0].na ,color: "grey" }
			]
		}
		]
	});


	var chart2 = new CanvasJS.Chart("piechartContainer", {
		title:{
			text: "output Indicators Pie chart"              
		},
		data: [              
		{
			// Change type to "doughnut", "line", "splineArea", etc.
			type: "pie",
			dataPoints: [
				{ label: "Target Acheived",  y: result[0].ontrack ,color: "green" },
				{ label: "Delayed", y: result[0].offtrack ,color: "red"},
				{ label: "In Progress", y: result[0].inProgress ,color: "yellow" },
				{ label: "NA", y: result[0].na ,color: "grey" }
			]
		}
		]
	});
	var chart3 = new CanvasJS.Chart("linechartContainer", {
		title:{
			text: "output Indicators Line chart"              
		},
		data: [              
		{
			// Change type to "doughnut", "line", "splineArea", etc.
			type: "line",
			dataPoints: [
				{ label: "Target Acheived",  y: result[0].ontrack ,color: "green" },
				{ label: "Delayed", y: result[0].offtrack ,color: "red"},
				{ label: "In Progress", y: result[0].inProgress ,color: "yellow" },
				{ label: "NA", y: result[0].na ,color: "grey" }
			]
		}
		]
	});
	var chart4 = new CanvasJS.Chart("scatteredchartContainer", {
		title:{
			text: "output Indicators Scatter chart"              
		},
		data: [              
		{
			// Change type to "doughnut", "line", "splineArea", etc.
			type: "scatter",
			dataPoints: [
				{ label: "Target Acheived",  y: result[0].ontrack ,color: "green" },
				{ label: "Delayed", y: result[0].offtrack ,color: "red"},
				{ label: "In Progress", y: result[0].inProgress ,color: "yellow" },
				{ label: "NA", y: result[0].na ,color: "grey" }
			]
		}
		]
	});
		chart1.render();
		chart2.render();
		chart3.render();
		chart4.render();
	
}
});
});		
});