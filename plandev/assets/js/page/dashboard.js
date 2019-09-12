$(document).ready(function(){

checkSuperAdmin();


$('#year_sel').html(window.localStorage.finYear);

// Chart.plugins.register({
//   beforeDraw: function(chartInstance) {
//     var ctx = chartInstance.chart.ctx;
//     ctx.fillStyle = "rgba(255, 255, 255, 0)";
//     ctx.fillRect(0, 0, chartInstance.chart.width, chartInstance.chart.height);
//   }
// });

// Chart.defaults.global.defaultFontColor = '#333';
// Chart.defaults.global.legend.labels.usePointStyle = true;

// console.log(window.localStorage.finYear);
$.ajax({
  	url: siteUrl + "/api/actionpoint_main",
  	headers: {
    	'Accept': 'application/json',
    	'Authorization': 'Bearer ' + window.localStorage.token
  	},
  	data:{
  		'finYear': window.localStorage.finYear
  	},
  	success: function(result){
   		sectorTable = $('#actionPointsTab').DataTable({
    		data: result['indicators']
   		});
 	},
 	error:function (error) {
      	// console.log(error.status);
      	if(error.status == 401){
        
        
        
  	}
}

});
$.ajax({
  	url: siteUrl + "/api/best_performing_dash",
  	headers: {
    	'Accept': 'application/json',
    	'Authorization': 'Bearer ' + window.localStorage.token
  	},
  	data:{
  		'finYear': window.localStorage.finYear
  	},
  	success: function(result){
  		$('.bestperdept').each(function(i,elem){
  			var t = $(elem).DataTable({
	    		data: result['departments'],
	    		"bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
			    "paging": false,//Dont want paging                
			    "bPaginate": false,//Dont want paging
			    'searching': false,
			    "columnDefs": [ {
		            "searchable": false,
		            "orderable": false,
		            "targets": 0
		        } ],
		        "order": [[ 2, 'desc' ]]
	   		});
	   		t.on( 'order.dt search.dt', function () {
		        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
		            cell.innerHTML = (i+1)+'.';
		        } );
		    } ).draw();
  		})
  		// var t = $('.bestperdept').DataTable({
    // 		data: result['departments'],
    // 		"bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
		  //   "paging": false,//Dont want paging                
		  //   "bPaginate": false,//Dont want paging
		  //   'searching': false,
		  //   "columnDefs": [ {
	   //          "searchable": false,
	   //          "orderable": false,
	   //          "targets": 0
	   //      } ],
	   //      "order": [[ 2, 'desc' ]]
   	// 	});
   	// 	t.on( 'order.dt search.dt', function () {
	   //      t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	   //          cell.innerHTML = (i+1)+'.';
	   //      } );
	   //  } ).draw();
  // 		console.log("best performing");
  // 		console.log(result);

  //  		$.each( result.departments, function( key, value ) {
  //  			var dept_id = key.substr(0, key.indexOf('+'));
  //  			var dept_name = key.substring(key.indexOf("+") + 1);
		// 	var htm = '<a href="dept_dashboard.html?dept_id='+dept_id+'">' + dept_name + ' <b>('+value+' % expenditure)</b></a>';
		// 	$('#bestperdept').append(htm);
		// });
 	},
 	error:function (error) {
      	// console.log(error.status);
      	if(error.status == 401){
        
        
        
  	}
}

});


$.ajax({
  	url: siteUrl + "/api/best_performing_dash_ind",
  	headers: {
    	'Accept': 'application/json',
    	'Authorization': 'Bearer ' + window.localStorage.token
  	},
  	data:{
  		'finYear': window.localStorage.finYear
  	},
  	success: function(result){
  		$('.bestperdeptInd').each(function(i,elem){
  			var t = $(elem).DataTable({
	    		data: result['departments'],
	    		"bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
			    "paging": false,//Dont want paging                
			    "bPaginate": false,//Dont want paging
			    'searching': false,
			    "columnDefs": [ {
		            "searchable": false,
		            "orderable": false,
		            "targets": 0
		        } ],
		        "order": [[ 2, 'desc' ]]
	   		});
	   		t.on( 'order.dt search.dt', function () {
		        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
		            cell.innerHTML = (i+1)+'.';
		        } );
		    } ).draw();
  		})
  		// var t = $('.bestperdeptInd').DataTable({
    // 		data: result['departments'],
    // 		"bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
		  //   "paging": false,//Dont want paging                
		  //   "bPaginate": false,//Dont want paging
		  //   'searching': false,
		  //   "columnDefs": [ {
	   //          "searchable": false,
	   //          "orderable": false,
	   //          "targets": 0
	   //      } ],
	   //      "order": [[ 2, 'desc' ]]
   	// 	});
   	// 	t.on( 'order.dt search.dt', function () {
	   //      t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	   //          cell.innerHTML = (i+1)+'.';
	   //      } );
	   //  } ).draw();
  // 		console.log("best performing");
  // 		console.log(result);

  //  		$.each( result.departments, function( key, value ) {
  //  			var dept_id = key.substr(0, key.indexOf('+'));
  //  			var dept_name = key.substring(key.indexOf("+") + 1);
		// 	var htm = '<a href="dept_dashboard.html?dept_id='+dept_id+'">' + dept_name + ' <b>('+value+' % expenditure)</b></a>';
		// 	$('#bestperdept').append(htm);
		// });
 	},
 	error:function (error) {
      	// console.log(error.status);
      	if(error.status == 401){
        
        
        
  	}
}

});


$.ajax({
  	url: siteUrl + "/api/best_performing_dash_ind_cri",
  	headers: {
    	'Accept': 'application/json',
    	'Authorization': 'Bearer ' + window.localStorage.token
  	},
  	data:{
  		'finYear': window.localStorage.finYear
  	},
  	success: function(result){
  		$('.bestperdeptIndCri').each(function(i,elem){
  			var t = $(elem).DataTable({
	    		data: result['departments'],
	    		"bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
			    "paging": false,//Dont want paging                
			    "bPaginate": false,//Dont want paging
			    'searching': false,
			    "columnDefs": [ {
		            "searchable": false,
		            "orderable": false,
		            "targets": 0
		        } ],
		        "order": [[ 2, 'desc' ]]
	   		});
	   		t.on( 'order.dt search.dt', function () {
		        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
		            cell.innerHTML = (i+1)+'.';
		        } );
		    } ).draw();
  		})
  		// var t = $('.bestperdeptIndCri').DataTable({
    // 		data: result['departments'],
    // 		"bInfo": false, //Dont display info e.g. "Showing 1 to 4 of 4 entries"
		  //   "paging": false,//Dont want paging                
		  //   "bPaginate": false,//Dont want paging
		  //   'searching': false,
		  //   "columnDefs": [ {
	   //          "searchable": false,
	   //          "orderable": false,
	   //          "targets": 0
	   //      } ],
	   //      "order": [[ 2, 'desc' ]]
   	// 	});
   	// 	t.on( 'order.dt search.dt', function () {
	   //      t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	   //          cell.innerHTML = (i+1)+'.';
	   //      } );
	   //  } ).draw();
  // 		console.log("best performing");
  // 		console.log(result);

  //  		$.each( result.departments, function( key, value ) {
  //  			var dept_id = key.substr(0, key.indexOf('+'));
  //  			var dept_name = key.substring(key.indexOf("+") + 1);
		// 	var htm = '<a href="dept_dashboard.html?dept_id='+dept_id+'">' + dept_name + ' <b>('+value+' % expenditure)</b></a>';
		// 	$('#bestperdept').append(htm);
		// });
 	},
 	error:function (error) {
      	// console.log(error.status);
      	if(error.status == 401){
        
        
        
  	}
}

});



$.ajax({
	url: siteUrl + "/api/get_chart_data_Establishment",
	headers: {
		'Accept': 'application/json',
		'Authorization': 'Bearer ' + window.localStorage.token
	},
  	data:{
  		'finYear': window.localStorage.finYear
  	},
	type: 'get',
	success: function(result){
		console.log(result);
		var data = [
			{ label: "Total Scheme Expenditure", y: result.totalSchemeExp, color: "#FF8300" },
			{ label: "Total Est. Expenditure", y: result.totalExp, color: '#000' }
		];
		// data = {
		// 	[]
		//     datasets: [{
		//         data: [, ],
		//         backgroundColor:['#FF8300', '#FFFF00']
		//     }],
		//     labels: [
		//         'Total Scheme Expenditure',
		//         'Total Est. Expenditure',
		//     ]
		// };
		drawPieChartNew('myChartEst', data);
		
	},
	error:function (error) {
		if(error.status == 401){
			$('.error-content').html('');
			var errorMsg = '<div class="alert alert-danger">Unauthorized Access. Please re-try</div>'
			$('.error-content').append(errorMsg);
		} else if (error.status == 0) {
			$('.error-content').html('');
			var errorMsg = '<div class="alert alert-danger">Something went wrong.</div>'
			$('.error-content').append(errorMsg);
		}
	}
});
$.ajax({
	url: siteUrl + "/api/get_dashboard_financials",
	headers: {
		'Accept': 'application/json',
		'Authorization': 'Bearer ' + window.localStorage.token
	},
  	data:{
  		'finYear': window.localStorage.finYear
  	},
	type: 'get',
	success: function(result){
		console.log(result);
		$('.total-estimate .value').html(result.totalEst);
		$('.total-exp .value').html(result.totalExp);
		$('.month-exp .value').html(result.current_month_exp);
		per = ((result.totalExp/result.totalEst)*100).toFixed(2);
		// console.log('per = ' +per);
		if(isNaN(per)){
			per = 'NA';
		}
		$('.perc-exp .value').html(per);
		
		// data = {
		//     datasets: [{
		//         data: [result.totalEst, result.totalExp, result.current_month_exp],
		//         backgroundColor:['#6181a2', '#5cb85c', '#FFFF00']
		//     }],
		//     labels: [
		//         'Total Allocation(B.E. - Rupees in Croress) ('+result.totalEst+')',
		//         'TOTAL EXPENDITURE(Rupees in Croress) ('+result.totalExp+')',
		//         'Current Month Expenditure ('+result.current_month_exp+')',
		//         // 'NA'
		//     ]
		// };
		var data = [
			{ label: 'Total Allocation(B.E. - Rs in Crores)', y: result.totalEst, color: "#6181a2" },
			{ label: 'Total Expenditure(Rs in Crores)', y: result.totalExp, color: '#5cb85c' },
			{ label: 'Current Month Expenditure', y: result.current_month_exp, color: '#FFFF00' }
		];
		drawPieChartNew('myPieChart2', data);
		drawBarChart('myChart2', data, 100);

	},
	error:function (error) {
		if(error.status == 401){
			$('.error-content').html('');
			var errorMsg = '<div class="alert alert-danger">Unauthorized Access. Please re-try</div>'
			$('.error-content').append(errorMsg);
		} else if (error.status == 0) {
			$('.error-content').html('');
			var errorMsg = '<div class="alert alert-danger">Something went wrong.</div>'
			$('.error-content').append(errorMsg);
		}
	}
});

$.ajax({
	url: siteUrl + "/api/get_dashboard_financials_sector",
	headers: {
		'Accept': 'application/json',
		'Authorization': 'Bearer ' + window.localStorage.token
	},
  	data:{
  		'finYear': window.localStorage.finYear
  	},
	type: 'get',
	success: function(result){
		
		// console.log(result);
		// console.log(result);
		var i=0;
		$.each( result.departments, function( key, value ) {
			//alert("here");
			++i;
			if(i%3 == 0){
				var cls = "right";
			}
			else{
				var cls = "";
			}
		   var sector = value;
		   //alert(sector.name);
		   var perf = result.totalExp[key] / result.totalEst[key];
		   if (isFinite(perf))
			{
			    // ...
			    perf = 0;
			}
			if(result.totalExp[key]){
			   	var htm = '<div class="col-md-4 dash-sec-thumb-main" data-perf="'+perf+'"><div class="dash-sec-thumb active"><div class="anch"><div class="title">'+sector.name+'</div></div><div class="dash-sec-thumb-dets" id="chartDrop2_'+key+'"><div id="chartCan2_'+key+'" width="300"></div></div><div class="thumb-ind-wrap"><div class="row"><div class="col-md-6"><div class="indi"><span class="thumb-ind-item">'+result.totalEst[key]+'</span> Allocation<span class="thumb-ind-item green">'+result.totalExp[key]+'</span></div></div><div class="col-md-6"><div class="sub-anchor-drop-in"><a href="dept_dashboard.html?dept_id='+sector.id+'">More</a></div></div></div></div><span class="sub-anchor"></span><div class="sub-anchor-drop"></div></div></div>';
				$('#sectorDashList1').append(htm);
				includeHTML();
				data = {
				    datasets: [{
				        data: [result.totalEst[key],result.totalExp[key]],
				        backgroundColor:['#5cb85c', '#FF8300']
				    }],

				    labels: [
				        'Estimate ('+result.totalEst[key]+')',
				        'Expenditure ('+result.totalExp[key]+')'
				    ]
				};
				var data = [
					{ label: 'Estimate', y: result.totalEst[key], color: "#5cb85c" },
					{ label: 'Expenditure', y: result.totalExp[key], color: '#FF8300' }
				];
				drawPieChartNew('chartCan2_'+key, data);

				
			}
		});

	},
	error:function (error) {
		if(error.status == 401){
			$('.error-content').html('');
			var errorMsg = '<div class="alert alert-danger">Unauthorized Access. Please re-try</div>'
			$('.error-content').append(errorMsg);
		} else if (error.status == 0) {
			$('.error-content').html('');
			var errorMsg = '<div class="alert alert-danger">Something went wrong.</div>'
			$('.error-content').append(errorMsg);
		}
	}
});

$.ajax({
	url: siteUrl + "/api/get_dashboard_counts",
	headers: {
		'Accept': 'application/json',
		'Authorization': 'Bearer ' + window.localStorage.token
	},
  	data:{
  		'finYear': window.localStorage.finYear
  	},
	type: 'get',
	success: function(result){
		 console.log(result);
		$('.total-schemes .value').html(result.schemesCount);
		$('.total-indicators .value').html(result.indicatorsCount);
		$('.on-track .value').html(result.ontrack);
		$('.off-track .value').html(result.offtrack);
		 $('.inprogress .value').html(result.na);
		 $('.notapplicable .value').html(result.inProgess);
		// $('.notapplicable .value').html(result.na);
		// $('.inprogress .value').html(result.inProgess);
		data = {
		    datasets: [{
		        data: [result.ontrack, result.offtrack, result.inProgess, result.na],
		        backgroundColor:['#9bbb58', '#c0504e', '#4f81bc','#4aacc5']
		    }],
		    labels: [
		        'On track ('+result.ontrack+')',
		        'Off track ('+result.offtrack+')',
		        'Not Applicable ('+result.inProgess+')',
		        'Not Reported ('+result.na+')'
		    ]
		};
		var data = [
			{ label: "On track", y: result.ontrack, color: "#9bbb58" },
			{ label: "Off track", y: result.offtrack, color: '#c0504e' },
			{ label: "Not Applicable", y: result.inProgess, color: '#4f81bc' },
			{ label: "Not Reported", y: result.na, color: '#4aacc5' }
		];
		drawPieChartNew('myPieChart', data);
		drawPolarChart('myPolarChart', data);
		drawDonutChart('myDoughnutChart', data);

		var barChartData = {
			datasets: [
			// {
			// 	label: 'Total Indicators ('+result.indicatorsCount+')',
			// 	backgroundColor: '#6181a2',
			// 	stack: 'Stack 0',
			// 	data: [result.indicatorsCount]
			// },
			{
				label: 'Not Reported ('+result.na+')',
				backgroundColor: '#999',
				stack: 'Stack 1',
				data: [result.na]
			},
			
			{
				label: 'On Track ('+result.ontrack+')',
				backgroundColor: '#5cb85c',
				stack: 'Stack 2',
				data: [result.ontrack]
			},
			{
				label: 'Off Track ('+result.offtrack+')',
				backgroundColor: '#b70000',
				stack: 'Stack 3',
				data: [result.offtrack]
			},
			{
				label: 'Not Applicable ('+result.inProgess+')',
				backgroundColor: '#FFFF00',
				stack: 'Stack 4',
				data: [result.inProgess]
			},

			]

		};
		drawBarChart('myChart1', data, 500);

		/*$.each( result.allOfftrackOutputIndicators, function( key, value ) {
			var htm = '<a href="output-target-baseline.html?indicator_id='+value.id +'">' + value.name + '</a>';
			$('#indicatorsScrollOfftrack').append(htm);
		});
		$.each( result.allOfftrackOutcomeIndicators, function( key, value ) {
			var htm = '<a href="outcome-target-baseline.html?indicator_id='+value.id +'">' + value.name + '</a>';
			$('#indicatorsScrollOfftrack').append(htm);
		});*/

	},
	error:function (error) {
		if(error.status == 401){
			$('.error-content').html('');
			var errorMsg = '<div class="alert alert-danger">Unauthorized Access. Please re-try</div>'
			$('.error-content').append(errorMsg);
		} else if (error.status == 0) {
			$('.error-content').html('');
			var errorMsg = '<div class="alert alert-danger">Something went wrong.</div>'
			$('.error-content').append(errorMsg);
		}
	}
});

$.ajax({
	url: siteUrl + "/api/get_chart_data_main",
	headers: {
		'Accept': 'application/json',
		'Authorization': 'Bearer ' + window.localStorage.token
	},
  	data:{
  		'finYear': window.localStorage.finYear
  	},
	type: 'get',
	success: function(result){
		var totalIndicators =  result.totalIndicators;
		var totalNa =  result.totalNa;
		var ontrack =  result.ontrack;
		var offtrack =  result.offtrack;
		var inprogress =  result.inprogress;
		
		// console.log(data);
		var lables = result.lables;

		// var barChartData = {
		// 	labels: lables,
		// 	datasets: [
		// 		// {
		// 		// 	label: 'Total Indicators',
		// 		// 	backgroundColor: '#6181a2',
		// 		// 	stack: 'Stack 0',
		// 		// 	data: totalIndicators
		// 		// },
		// 		{
		// 			label: 'NR (Not Reported)',
		// 			backgroundColor: '#999',
		// 			stack: 'Stack 0',
		// 			data: totalNa
		// 		},
				
		// 		{
		// 			label: 'On Track',
		// 			backgroundColor: '#5cb85c',
		// 			stack: 'Stack 0',
		// 			data: ontrack
		// 		},
		// 		{
		// 			label: 'Off Track',
		// 			backgroundColor: '#B70000',
		// 			stack: 'Stack 0',
		// 			data: offtrack
		// 		},
		// 		{
		// 			label: 'Not Applicable',
		// 			backgroundColor: '#FFFF00',
		// 			stack: 'Stack 0',
		// 			data: inprogress
		// 		},
		// 	]
		// };
		drawBarChartStacked('myChart', result, 500);
		var i = 0;
		$.each( result.sectors, function( key, value ) {
			if(i%3 == 0){
				var cls = "right";
			}
			else{
				var cls = "";
			}
			++i;
		   var sector = value;
		   //alert(sector.name);
		   var total_ind = result.xontrack[sector.id] + result.xtotalNa[sector.id] + result.xofftrack[sector.id] + result.xinprogress[sector.id];
		   var total_on = result.xontrack[sector.id];
		   var perf = total_on / total_ind;
		   if (!isFinite(perf))
			{
			    // ...
			    perf = 0;
			}

			if(total_ind){
			   	var htm = '<div class="col-md-4 dash-sec-thumb-main main-dash" data-perf="'+perf+'"><div class="dash-sec-thumb active"><div class="anch"><div class="title">'+sector.name+'</div></div><div class="dash-sec-thumb-dets" id="chartDrop_'+sector.id+'"><div style="width: 100%;" id="chartCan_'+sector.id+'"></div></div><div class="thumb-ind-wrap"><div class="row"><div class="col-md-6"><div class="indi"><span class="thumb-ind-item">'+result.xtotalNa[sector.id]+'</span><span class="thumb-ind-item green">'+result.xontrack[sector.id]+'</span><span class="thumb-ind-item red">'+result.xofftrack[sector.id]+'</span><span class="thumb-ind-item yellow">'+result.xinprogress[sector.id]+'</span></div></div><div class="col-md-6"><div class="sub-anchor-drop-in"><a href="dept_dashboard.html?dept_id='+sector.id+'">More</a></div></div></div></div><span class="sub-anchor"></span><div class="sub-anchor-drop"></div></div></div>';
				
				// var htm2 = '<div class="dash-sec-thumb-dets-in" id="chartDrop_'+sector.id+'"><canvas id="chartCan_'+sector.id+'" width="500"></canvas></div>';
				$('#sectorDashList').append(htm);
				// $('#sectorDashList1').append(htm);
				// $('#chartSectContainer').append(htm2);
				includeHTML();
				// data = {
				//     datasets: [{
				//         data: [result.xontrack[sector.id],result.xofftrack[sector.id],result.xinprogress[sector.id],result.xtotalNa[sector.id]],
				//         backgroundColor:['#5cb85c', '#b70000', '#FFFF00','#999']
				//     }],

				//     labels: [
				//         'On track ('+result.xontrack[sector.id]+')',
				//         'Off track ('+result.xofftrack[sector.id]+')',
				//         'Not Applicable ('+result.xinprogress[sector.id]+')',
				//         'Not Reported ('+result.xtotalNa[sector.id]+')'
				//     ]
				// };
				var data = [
					{ label: "On track", y: result.xontrack[sector.id], color: "#5cb85c" },
					{ label: "Off track", y: result.xofftrack[sector.id], color: '#b70000' },
					{ label: "Not Applicable", y: result.xinprogress[sector.id], color: '#FFFF00' },
					{ label: "Not Reported", y: result.xtotalNa[sector.id], color: '#999' }
				];
				if(!isNaN(sector.id)){
					drawPieChartNew('chartCan_'+sector.id, data);
				}
			}
		});
	},
	error:function (error) {
		if(error.status == 401){
			$('.error-content').html('');
			var errorMsg = '<div class="alert alert-danger">Unauthorized Access. Please re-try</div>'
			$('.error-content').append(errorMsg);
		} else if (error.status == 0) {
			$('.error-content').html('');
			var errorMsg = '<div class="alert alert-danger">Something went wrong.</div>'
			$('.error-content').append(errorMsg);
		}
	}
});
	$.ajax({
			url: siteUrl + "/api/get_dashboard_counts_critical",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + window.localStorage.token
			},
		  	data:{
		  		'finYear': window.localStorage.finYear
		  	},
			type: 'get',
			success: function(result){
				// console.log(result);
				$('.total-schemes1 .value').html(result.schemesCount);
				$('.total-indicators1 .value').html(result.indicatorsCount);
				$('.on-track1 .value').html(result.ontrack);
				$('.off-track1 .value').html(result.offtrack);
				$('.inprogress1 .value').html(result.inProgess);
				$('.notapplicable1 .value').html(result.na);
				// data = {
				//     datasets: [{
				//         data: [result.ontrack, result.offtrack, result.inProgess, result.na],
				//         backgroundColor:['#5cb85c', '#b70000', '#FFFF00','#999']
				//     }],
				//     labels: [
				//         'On track',
				//         'Off track',
				//         'Not Applicable',
				//         'Not Reported'
				//     ]
				// };

				var data = [
					{ label: "On track", y: result.ontrack, color: "#5cb85c" },
					{ label: "Off track", y: result.offtrack, color: '#b70000' },
					{ label: "Not Applicable", y: result.inProgess, color: '#FFFF00' },
					{ label: "Not Reported", y: result.na, color: '#999' }
				];
				drawPieChartNew('myPieChart5', data);
				drawPolarChart('myPolarChart5', data);
				drawDonutChart('myDoughnutChart5', data);
				var barChartData = {
					datasets: [
					{
						label: 'Total Indicators',
						backgroundColor: '#6181a2',
						stack: 'Stack 0',
						data: [result.indicatorsCount]
					},
					{
						label: 'Not Reported',
						backgroundColor: '#999',
						stack: 'Stack 1',
						data: [result.na]
					},
					
					{
						label: 'On Track',
						backgroundColor: '#5cb85c',
						stack: 'Stack 2',
						data: [result.ontrack]
					},
					{
						label: 'Off Track',
						backgroundColor: '#B70000',
						stack: 'Stack 3',
						data: [result.offtrack]
					},
					{
						label: 'Not Applicable',
						backgroundColor: '#FFFF00',
						stack: 'Stack 4',
						data: [result.inProgess]
					},

					]

				};
				drawBarChart('myChart5', data, 500);
				$.each( result.allOfftrackOutputIndicators, function( key, value ) {
					var htm = '<a href="output-target-baseline.html?indicator_id='+value.id +'">' + value.name + '</a>';
					$('#indicatorsScrollOfftrack').append(htm);
				});
				$.each( result.allOfftrackOutcomeIndicators, function( key, value ) {
					var htm = '<a href="outcome-target-baseline.html?indicator_id='+value.id +'">' + value.name + '</a>';
					$('#indicatorsScrollOfftrack').append(htm);
				});

			},
			error:function (error) {
				if(error.status == 401){
					$('.error-content').html('');
					var errorMsg = '<div class="alert alert-danger">Unauthorized Access. Please re-try</div>'
					$('.error-content').append(errorMsg);
				} else if (error.status == 0) {
					$('.error-content').html('');
					var errorMsg = '<div class="alert alert-danger">Something went wrong.</div>'
					$('.error-content').append(errorMsg);
				}
			}
		});


		$.ajax({
			url: siteUrl + "/api/get_chart_data_critical",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + window.localStorage.token
			},
		  	data:{
		  		'finYear': window.localStorage.finYear
		  	},
			type: 'get',
			success: function(result){
				var totalIndicators =  result.totalIndicators;
				var totalNa =  result.totalNa;
				var ontrack =  result.ontrack;
				var offtrack =  result.offtrack;
				var inprogress =  result.inprogress;
				
				// console.log(data);
				var lables = result.lables;



				var barChartData = {
					labels: lables,
					datasets: [
					// {
					// 	label: 'Total Indicators',
					// 	backgroundColor: '#6181a2',
					// 	stack: 'Stack 0',
					// 	data: totalIndicators
					// },
					{
						label: 'Not Reported',
						backgroundColor: '#999',
						stack: 'Stack 0',
						data: totalNa
					},
					
					{
						label: 'On Track',
						backgroundColor: '#5cb85c',
						stack: 'Stack 0',
						data: ontrack
					},
					{
						label: 'Off Track',
						backgroundColor: '#B70000',
						stack: 'Stack 0',
						data: offtrack
					},
					{
						label: 'Not Applicable',
						backgroundColor: '#FFFF00',
						stack: 'Stack 0',
						data: inprogress
					},

					]

				};
				// drawBarChartStacked('myChart6', barChartData, 500);

				var i = 0;
				$.each( result.sectors, function( key, value ) {
					++i;
					if(i%3 == 0){
						var cls = "right";
					}
					else{
						var cls = "";
					}
				   var sector = value;
				   //alert(sector.name);

				   var sector = value;
				   //alert(sector.name);
				   var total_ind = result.xontrack[sector.id] + result.xtotalNa[sector.id] + result.xofftrack[sector.id] + result.xinprogress[sector.id];
				   var total_on = result.xontrack[sector.id];
				   var perf = total_on / total_ind;
				   if (isFinite(perf))
					{
					    // ...
					    perf = 0;
					}
					if(total_ind){
					   	var htm = '<div class="col-md-4 dash-sec-thumb-main" data-perf="'+perf+'"><div class="dash-sec-thumb active"><div class="anch"><div class="title">'+sector.name+'</div></div><div class="dash-sec-thumb-dets" id="chartDrop5_'+sector.id+'"><div id="chartCan5_'+sector.id+'" width="500"></div></div><div class="thumb-ind-wrap"><div class="row"><div class="col-md-6"><div class="indi"><span class="thumb-ind-item">'+result.xtotalNa[sector.id]+'</span><span class="thumb-ind-item green">'+result.xontrack[sector.id]+'</span><span class="thumb-ind-item red">'+result.xofftrack[sector.id]+'</span><span class="thumb-ind-item yellow">'+result.xinprogress[sector.id]+'</span></div></div><div class="col-md-6"><div class="sub-anchor-drop-in"><a href="dept_dashboard.html?dept_id='+sector.id+'">More</a></div></div></div><span class="sub-anchor"></span><div class="sub-anchor-drop"></div></div></div>';
						
						// var htm2 = '<div class="dash-sec-thumb-dets-in" id="chartDrop_'+sector.id+'"><canvas id="chartCan_'+sector.id+'" width="500"></canvas></div>';
						$('#sectorDashList5').append(htm);
						// $('#sectorDashList1').append(htm);
						// $('#chartSectContainer').append(htm2);
						includeHTML();
						// var ctx = document.getElementById().getContext('2d');
						data = {
						    datasets: [{
						        data: [result.xontrack[sector.id],result.xofftrack[sector.id],result.xinprogress[sector.id],result.xtotalNa[sector.id]],
						        backgroundColor:['#5cb85c', '#b70000', '#FFFF00','#999']
						    }],

						    labels: [
						        'On track',
						        'Off track',
						        'Not Applicable',
						        'Not Reported'
						    ]
						};

						var data = [
							{ label: "On track", y: result.xontrack[sector.id], color: "#5cb85c" },
							{ label: "Off track", y: result.xofftrack[sector.id], color: '#b70000' },
							{ label: "Not Applicable", y: result.xinprogress[sector.id], color: '#FFFF00' },
							{ label: "Not Reported", y: result.xtotalNa[sector.id], color: '#999' }
						];
							drawPieChartNew('chartCan5_'+sector.id, data);
							// var myPieChart = new Chart(ctx,{
							//     type: 'pie',
							//     data: data,
							//     options: {
							// 		defaultFontColor: '#000',
							//     	legend: {
							//     		position: 'top'
							//     	},
							// 		showTooltips: true,
							//     	cutoutPercentage: 0
							//     }
							// });
						}

					

				});


			},
			error:function (error) {
				if(error.status == 401){
					$('.error-content').html('');
					var errorMsg = '<div class="alert alert-danger">Unauthorized Access. Please re-try</div>'
					$('.error-content').append(errorMsg);
				} else if (error.status == 0) {
					$('.error-content').html('');
					var errorMsg = '<div class="alert alert-danger">Something went wrong.</div>'
					$('.error-content').append(errorMsg);
				}
			}
		});

		$('.sortPerf').on('change', function(){
			var val = $(this).val();
			var targ_cont = $(this).attr('data-target');
			var divList = $(targ_cont).find(".dash-sec-thumb-main");
			if(val == 2){
				divList.sort(function(a, b){
				    return $(a).data('perf')-$(b).data('perf')
				});
				$(targ_cont).html(divList);
			}
			else if(val == 1){
				divList.sort(function(a, b){
				    return $(b).data('perf')-$(a).data('perf')
				});
				$(targ_cont).html(divList);
			}
		})
});


function drawBarChart(target, barChartData, yGap){
	// return true;
	var chart = new CanvasJS.Chart(target, {
		animationEnabled: true,
		backgroundColor: null,
		indexLabelOrientation: "vertical",
		dataPointMaxWidth: 20,
		axisX:{
		   labelAngle: 0,
		   labelAutoFit: true,
		},
		data: [{        
			type: "column",
			showInLegend: true,
			dataPoints: barChartData
		}]
	});
	chart.render();
}

function drawBarChartStacked(target, barChartData, yGap){

	// console.log(barChartData);
	var options = {
		backgroundColor: null,
		bevelEnabled: true,
		zoomEnabled:true,
		legend:{
			fontSize: 12,
			cursor:"pointer",
			itemclick : toggleDataSeries,
			fontweight: "bold",
			// fontColor: '#FFF'
		},
		toolTip: {
			shared: true,
			content: toolTipFormatter
		},
		axisX:{
		   labelFontSize: 12,
		   interval: 1
	 	},
		axisY:{
		   labelFontSize: 12
	 	},
		data: [
			{
				type: "bar",
				showInLegend: true,
				name: "On Track",
				color: "#5cb85c",
				indexLabelFontSize: 12,
				dataPoints: barChartData.on_all_arr
			},
			{
				type: "bar",
				showInLegend: true,
				name: "Off Track",
				color: "#b70000",
				indexLabelFontSize: 12,
				dataPoints: barChartData.off_all_arr
			},
			{
				type: "bar",
				showInLegend: true,
				name: "NA",
				color: "#FFFF00",
				indexLabelFontSize: 12,
				dataPoints: barChartData.na_all_arr
			},
			{
				type: "bar",
				showInLegend: true,
				name: "NR",
				color: "#999",
				indexLabelFontSize: 12,
				dataPoints: barChartData.prog_all_arr
			}
		]
	};
	$('#'+target).CanvasJSChart(options);

	// return true;

	// var chart = new CanvasJS.Chart(target, {
	// 	animationEnabled: true,
	// 	indexLabelOrientation: "vertical",
	// 	dataPointMaxWidth: 20,
	// 	axisX:{
	// 	   labelAngle: 0,
	// 	   labelAutoFit: true,
	// 	},
	// 	data: [{
	// 		type: "bar",
	// 		showInLegend: true,
	// 		name: "On Track",
	// 		color: "gold",
	// 		dataPoints: barChartData.on_all_arr
	// 	},
	// 	{
	// 		type: "bar",
	// 		showInLegend: true,
	// 		name: "OffTrack",
	// 		color: "silver",
	// 		dataPoints: barChartData.off_all_arr
	// 	},
	// 	{
	// 		type: "bar",
	// 		showInLegend: true,
	// 		name: "NA",
	// 		color: "#A57164",
	// 		dataPoints: barChartData.na_all_arr
	// 	},
	// 	{
	// 		type: "bar",
	// 		showInLegend: true,
	// 		name: "InProgress",
	// 		color: "#ff0",
	// 		dataPoints: barChartData.prog_all_arr
	// 	}]
	// });
	// chart.render();


		return true;

	// var ctx1 = document.getElementById(target).getContext('2d');
	
	// window.myBar = new Chart(ctx1, {
	// 	type: 'horizontalBar',
	// 	data: barChartData,
	// 	options: {
	// 		defaultFontSize: 12,
	// 		showTooltips: true,
	// 		legend: {
 //            	display: true,
 //            	position: 'bottom',
 //            	labels: {
 //            		// fontColor: '#777',
 //            		padding: 10,
 //            		fontSize: 12,
 //            	}
 //        	},
	// 		title: {
	// 			display: false,
	// 			text: 'Progress Indicators'
	// 		},
	// 		tooltips: {
	// 			enabled: true,
	// 			mode: 'index',
	// 			intersect: true
	// 		},
	// 		responsive: true,
	//     	maintainAspectRatio: true,
	//     	aspectRatio: 1,
	// 		scales: {
	// 			xAxes: [{
	// 				barPercentage: 0.2,
	// 				stacked: true,
	// 				gridLines: {
	// 					display: false,
	//                     color: "#DDD",
	//                     borderDash: [2,2],
	//                 },
	//                 ticks: {
	// 	                fontSize: 10,
	//                     // maxRotation: 90,
	//                     // minRotation: 90,

	// 	            },
	// 	            scaleLabel: {
	// 			        display: true,
	// 			        fontSize: 20,
	// 			        labelString: 'Delhi Government'
	// 		      	}
	// 			}],
	// 			yAxes: [{
	// 				stacked: true,
	// 				gridLines: {
	//                     color: "#DDD",
	//                     borderDash: [2,2],
	//                 },
	// 		      	ticks: {
	// 		        	stepSize: yGap,
	// 		        	beginAtZero: true,
 //      					padding: 25,
	// 		      	},
	// 	            scaleLabel: {
	// 			        display: true,
	// 			        fontSize: 12,
	// 			        // labelString: '(In numbers)'
	// 		      	}
	// 			}]
	// 		}
	// 	}
	// });
}

function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else {
		e.dataSeries.visible = true;
	}
	chart.render();
}


function toolTipFormatter(e) {
	var str = "";
	var total = 0 ;
	var str3;
	var str2 ;
	for (var i = 0; i < e.entries.length; i++){
		var str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\">" + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + "</strong> <br/>" ;
		total = e.entries[i].dataPoint.y + total;
		str = str.concat(str1);
	}
	str2 = "<strong>" + e.entries[0].dataPoint.label + "</strong> <br/>";
	str3 = "<span style = \"color:Tomato\">Total: </span><strong>" + total + "</strong><br/>";
	return (str2.concat(str)).concat(str3);
}




function drawPieChart(target, dataPoints){
	return true;
}
function drawPieChartNew(target, dataPoints){
	// console.log(dataPoints);
	var options = {
		backgroundColor: null,
		// bevelEnabled: true,
		// zoomEnabled:true,
		legend:{
			fontSize: 12,
			fontweight: "bold",
			horizontalAlign: "center",
			verticalAlign: "bottom",
			// fontColor: '#FFF'
			maxWidth: 350,
			itemWidth: 80
		},
		data: [{
				type: "pie",
				startAngle: 90,
				radius: 120,
				showInLegend: "true",
				legendText: "{label}",
				indexLabel: "{label} ({y})",
				indexLabelPlacement: "outside",
				indexLabelOrientation: "horizontal",
				indexLabelFontSize: 9,
				indexLabelFontWeight: "normal",
				indexLabelFontColor: '#222',
				yValueFormatString:"#,##0.#"%"",
				dataPoints: dataPoints
		}]
	};
	$('#'+target).CanvasJSChart(options);

	// var ctx = document.getElementById(target).getContext('2d');
	// var myPieChart = new Chart(ctx,{
	//     type: 'pie',
	//     data: data,
	//     options: {
	// 		responsive: true,
	//     	maintainAspectRatio: true,
	//     	aspectRatio: 1,
	//     	legend: {
	//     		position: 'inside'
	//     	},
 //        	pieceLabel: {
	// 		    render: 'percentage',
	// 		    fontColor: '#444',
	// 		    position: 'outside',
	// 		    textMargin: 10,
	// 		    fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
	// 		    fontSize: 17,
	// 		    precision: 2
	// 	  	},
	// 		showTooltips: true,
	//     	cutoutPercentage: 10
	//     }
	// });
}

function drawDonutChart(target, dataPoints){
	var options = {
		backgroundColor: null,
		// bevelEnabled: true,
		// zoomEnabled:true,
		legend:{
			fontSize: 12,
			fontweight: "bold",
			// fontColor: '#FFF'
		},
		data: [{
				type: "doughnut",
				startAngle: 45,
				radius: 150,
				innerRadius: 70,
				showInLegend: "true",
				legendText: "{label}",
				indexLabel: "{label} ({y})",
				indexLabelPlacement: "outside",
				indexLabelFontSize: 12,
				indexLabelFontWeight: "normal",
				indexLabelFontColor: '#222',
				yValueFormatString:"#,##0.#"%"",
				dataPoints: dataPoints
		}]
	};
	$('#'+target).CanvasJSChart(options);
	return true;
	// var ctx3 = document.getElementById(target).getContext('2d');
	// var myPieChart = new Chart(ctx3,{
	//     type: 'doughnut',
	//     data: data,
	//     options: {
	// 		responsive: true,
	//     	maintainAspectRatio: true,
	//     	aspectRatio: 1,
	//     	legend: {
	//     		position: 'bottom'
	//     	},
 //        	pieceLabel: {
	// 		    render: 'percentage',
	// 		    fontColor: '#FFF',
	// 		    precision: 2
	// 	  	},
	// 		tooltips: {
	// 			mode: 'index',
	// 			intersect: false
	// 		}
	//     }
	// });
}


function drawPolarChart(target, dataPoints){
	var options = {
		backgroundColor: null,
		bevelEnabled: true,
		zoomEnabled:true,
		legend:{
			fontSize: 12,
			fontweight: "bold",
			// fontColor: '#FFF'
		},
		data: [{
				type: "pyramid",
				startAngle: 45,
				radius: 150,
				innerRadius: 70,
				showInLegend: "true",
				legendText: "{label}",
				indexLabel: "{label} ({y})",
				indexLabelPlacement: "outside",
				indexLabelFontSize: 12,
				indexLabelFontWeight: "normal",
				indexLabelFontColor: '#222',
				yValueFormatString:"#,##0.#"%"",
				dataPoints: dataPoints
		}]
	};
	$('#'+target).CanvasJSChart(options);
	return true;
	// var ctx2 = document.getElementById(target).getContext('2d');
	// var myPieChart = new Chart(ctx2,{
	//     type: 'polarArea',
	//     data: data,
	//     options: {
	// 		responsive: true,
	//     	maintainAspectRatio: true,
	//     	aspectRatio: 1,
	//     	legend: {
	//     		position: 'bottom'
	//     	},
 //        	pieceLabel: {
	// 		    render: 'percentage',
	// 		    fontColor: '#FFF',
	// 		    precision: 2
	// 	  	},
	// 		showTooltips: true,
	// 		tooltips: {
	// 			mode: 'index',
	// 			intersect: false
	// 		}
	//     }
	// });
}