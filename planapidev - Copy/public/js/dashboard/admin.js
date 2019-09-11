$( document ).ready(function() {
		$('.viewDepartmentDashboard').click(function(){
			var deptId = $(this).attr('data-id');
			widow.location = location.href + '/view/'+deptId;
		});
	
	$('.view-scheme-progress').click(function(){
		var schemeId= $('#report_scheme_id').val();
			var reportUrl= location.href+'/schemeprogress/'+schemeId;
			 $.ajax({url: reportUrl,method:'get', success: function(result){
        	 	$('#detailChartContainer').html('');
 				$('#detailChartContainer').append('<div class="chart-heading">Output Indicators</div><table><tr><td>Total Indicators </td><td>'+result[0].output_total+'</td></tr><tr><td>Achieved Indicators </td><td style="background:green;">'+result[0].output_ontrack+'</td></tr><tr><td>Indicators Delayed </td><td style="background:red;">'+result[0].output_offtrack+'</td></tr><tr><td>Indicators In Progress </td><td style="background:yellow;">'+result[0].output_inProgress+'</td></tr><tr><td>Indicators Data Missing</td><td style="background:grey;">'+result[0].output_notApplicable+'</td></tr></table>');


        var chart1 = new CanvasJS.Chart("outputbarchartContainer", {
		title:{
			text: "Scheme output progress"              
		},
		data: [              
		{
			// Change type to "doughnut", "line", "splineArea", etc.
			type: "pie",
			dataPoints: [
				{ label: "Target Acheived",  y: result[0].output_ontrack ,color: "green" },
				{ label: "Delayed", y: result[0].output_offtrack ,color: "red"},
				{ label: "In Progress", y: result[0].output_inProgress ,color: "yellow"},
				{ label: "NA", y: result[0].output_notApplicable ,color: "grey" }
			]
		}
		]
	});

        var chart2 = new CanvasJS.Chart("outcomebarchartContainer", {
		title:{
			text: "Scheme outcome progress"              
		},
		data: [              
		{
			// Change type to "doughnut", "line", "splineArea", etc.
			type: "pie",
			dataPoints: [
				{ label: "on track",  y: result[0].outcome_ontrack ,color: "green" },
				{ label: "Delayed", y: result[0].outcome_offtrack ,color: "red"},
				{ label: "In Progress", y: result[0].outcome_inProgress ,color: "yellow"},
				{ label: "NA", y: result[0].outcome_notApplicable ,color: "grey" }
			]
		}
		]
	});



		chart1.render();
		chart2.render();
	
}
});


});	
	$('.view-organisation-progress').click(function(){
		var deptId= $('#report_department_id').val();
		$('.display-department-selected').css('display','block');
		var deptDetailsUrl = location.href+'/deptDetails/'+deptId;
					 $.ajax({url: deptDetailsUrl,method:'get', success: function(result){
					 	console.log(result);
					 	$('.display-department-selected tbody').html('');
					 	$('.display-department-selected tbody').append('<tr><td>'+result.name+'</td><td><button data-id="'+deptId+'" class="btn btn-primary viewDepartmentDashboard">view</button></td></tr>')
            }});
		
			var reportUrl= location.href+'/progress/'+deptId;
			 $.ajax({url: reportUrl,method:'get', success: function(result){
					 	
					 	$('#detailChartContainer').html('');
 				$('#detailChartContainer').append('<div class="chart-heading">Output Indicators</div><table><tr><td>Total Indicators </td><td>'+result[0].output_total+'</td></tr><tr><td>Achieved Indicators </td><td style="background:green;">'+result[0].output_ontrack+'</td></tr><tr><td>Indicators Delayed </td><td style="background:red;">'+result[0].output_offtrack+'</td></tr><tr><td>Indicators In Progress </td><td style="background:yellow;">'+result[0].output_inProgress+'</td></tr><tr><td>Indicators Data Missing</td><td style="background:grey;">'+result[0].output_notApplicable+'</td></tr></table>');

        var chart1 = new CanvasJS.Chart("outputbarchartContainer", {
		title:{
			text: "All Schemes output progress"              
		},
		data: [              
		{
			// Change type to "doughnut", "line", "splineArea", etc.
			type: "pie",
			dataPoints: [
				{ label: "on track",  y: result[0].output_ontrack ,color: "green" },
				{ label: "Delayed", y: result[0].output_offtrack ,color: "red"},
				{ label: "In Progress", y: result[0].output_inProgress ,color: "yellow"},
				{ label: "NA", y: result[0].output_notApplicable ,color: "grey" }
			]
		}
		]
	});

        var chart2 = new CanvasJS.Chart("outcomebarchartContainer", {
		title:{
			text: "All Schemes outcome progress"              
		},
		data: [              
		{
			// Change type to "doughnut", "line", "splineArea", etc.
			type: "pie",
			dataPoints: [
				{ label: "on track",  y: result[0].outcome_ontrack ,color: "green" },
				{ label: "Delayed", y: result[0].outcome_offtrack ,color: "red"},
				{ label: "In Progress", y: result[0].outcome_inProgress ,color: "yellow"},
				{ label: "NA", y: result[0].outcome_notApplicable ,color: "grey" }
			]
		}
		]
	});



		chart1.render();
		chart2.render();
	
}
});

		var schemesUrl= location.href+'/getAllSchemes/'+deptId;
			 $.ajax({url: schemesUrl,method:'get', success: function(result){
       				 	 $("#report_scheme_id").html('<option value="0">--select scheme--</option>');
			 	result.forEach(function(entry) {
   					
   					 $("#report_scheme_id").append('<option value="'+entry.schemeId+'">'+entry.schemeName+'</option>');
			});
       }});	 

});		
});