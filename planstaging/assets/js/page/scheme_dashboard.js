$(document).ready(function(){


	

	var urlParams = new URLSearchParams(window.location.search);
	var scheme_id = urlParams.get('scheme_id');

	Chart.plugins.register({
  beforeDraw: function(chartInstance) {
    var ctx = chartInstance.chart.ctx;
    ctx.fillStyle = "rgba(255, 255, 255, 0)";
    ctx.fillRect(0, 0, chartInstance.chart.width, chartInstance.chart.height);
  }

});

	$.ajax({async: true,
		url: siteUrl + "/api/schemes/"+scheme_id+"/edit",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		success: function(result){
			console.log(result);
			var department_id = result.scheme.department_id;
			$('#schemeName').html(result.scheme.scheme_name);
			$.each(result.scheme.departments, function(key, value){
				if(value.id == department_id){
					$('#departmentName').html(value.name);
				}
			});
			if(result.scheme.end_date){
				$('#duration').html($.date(result.scheme.start_date) + ' to ' + $.date(result.scheme.end_date));
			}
			else{
				$('#duration').html($.date(result.scheme.start_date) + ' to Ongoing');
			}
			$('#code').html(result.scheme.code);
			$('#scheme_type').html((result.scheme.scheme_type == 1)?"State":"Central");
			$('#account_head').html(result.scheme.account_head);
			$('#demand_no').html(result.scheme.demand_no);
			$('#remarks').html(result.scheme.remarks);
			$('#mon_types').html(result.scheme.mon_type_names);
			$('#tags').html(result.scheme.tag_list_names);
			$('#is_capital').html((result.scheme.is_capital == 1)?"Yes":"No");
			if(result.scheme.is_capital == 1){
				$('#latitude').html(result.scheme.latitude);
				$('#longitude').html(result.scheme.longitude);
				var latitude = result.scheme.latitude;
				var longitude = result.scheme.longitude;
				var map; var marker;
				var myLatLng = {lat: parseFloat(latitude), lng: parseFloat(longitude)};
				console.log(myLatLng);
		  		function initMap() {
		        	map = new google.maps.Map(document.getElementById('map'), {
		          		center: myLatLng,
		          		zoom: 8
		        	});
		        	marker = new google.maps.Marker({
					    position: myLatLng,
					    map: map,
				  	});
		      	}
				initMap();
			}
			else{
				$('.locDiv').hide();
			}
		}
	});

Chart.defaults.global.defaultFontColor = '#000';
Chart.defaults.global.legend.labels.usePointStyle = true;

$.ajax({async: true,
  	url: siteUrl + "/api/actionpoint_scheme",
  	headers: {
    	'Accept': 'application/json',
    	'Authorization': 'Bearer ' + localStorage.token
  	},
  	data:{'scheme_id':scheme_id},
  	success: function(result){
   		sectorTable = $('#actionPointsTab').DataTable({
    		data: result['indicators']
   		});
 	},
 	error:function (error) {
      	console.log(error.status);
	      	if(error.status == 401){
	        
	        
	        
	  	}
	}

});


$.ajax({async: true,
	url: siteUrl + "/api/get_scheme_indicators_list",
	headers: {
		'Accept': 'application/json',
		'Authorization': 'Bearer ' + localStorage.token
	},
	data:{ 'scheme_id': scheme_id},
	type: 'get',
	success: function(result){
		// alert('abc');
		var i = 0;
		$.each( result.indicators, function( key, value ) {
	   		++i;
			if(i%3==0){
				var cls = "right";
			}
			else{
				var cls = "";
			}
		   	console.log(value);
			var htm = '<div class="col-md-4"><div class="dash-sec-thumb"><a class="anch"><div class="title">'+value.name+'</div></a><div class="sub-anchor-drop"><div class="sub-anchor-drop-in"><a href="indicator_dashboard.html?type='+value.type+'&id='+value.id+'">View Indicator Details</a></div></div></div></div>';
			$('#sectorDashList').append(htm);
		});
	}
});


$.ajax({async: true,
	url: siteUrl + "/api/get_dashboard_financials_scheme",
	headers: {
		'Accept': 'application/json',
		'Authorization': 'Bearer ' + localStorage.token
	},
	data:{'scheme_id':scheme_id,'finYear': window.localStorage.finYear},
	type: 'get',
	success: function(result){
		console.log(result);
		$('.total-estimate .value').html(result.totalEst);
		$('.total-exp .value').html(result.totalExp);
		$('.month-exp .value').html(result.current_month_exp);
		per = Math.round((result.totalExp/result.totalEst)*100);
		// console.log('per = ' +per);
		if(isNaN(per)){
			per = 'NA';
		}
		$('.perc-exp .value').html(per);
		data = {
		    datasets: [{
		        data: [result.totalEst, result.totalExp, result.current_month_exp],
		        backgroundColor:['#6181a2', '#37942c', '#FFFF00']
		    }],
		    labels: [
		        'Total Estimate',
		        'TOTAL EXPENDITURE(Rupees in Croress)',
		        'Current Month Expenditure',
		        // 'NA'
		    ]
		};
		drawPieChart('myPieChart2', data);
		drawPolarChart('myPolarChart2', data);
		drawDonutChart('myDoughnutChart2', data);
		var barChartData = {
			labels: ['Delhi Government'],
			datasets: [
			{
				label: 'Total Estimate',
				backgroundColor: '#6181a2',
				stack: 'Stack 0',
				data: [result.totalEst]
			},
			{
				label: 'TOTAL EXPENDITURE(Rupees in Croress)',
				backgroundColor: '#37942c',
				stack: 'Stack 1',
				data: [result.totalExp]
			},
			
			{
				label: 'Current Month Expenditure',
				backgroundColor: '#FFFF00',
				stack: 'Stack 2',
				data: [result.current_month_exp]
			}

			]

		};
		drawBarChart('myChart2', barChartData);//, 100000
	}
});

	$.ajax({async: true,
			url: siteUrl + "/api/get_dashboard_counts_scheme",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			data:{'scheme_id':scheme_id},
			type: 'get',
			success: function(result){
				console.log(result);
				$('.total-schemes .value').html(result.schemesCount);
				$('.total-indicators .value').html(result.indicatorsCount);
				$('.on-track .value').html(result.ontrack);
				$('.off-track .value').html(result.offtrack);
				$('.inprogress .value').html(result.inProgess);
				$('.notapplicable .value').html(result.na);
				$('#dashSecThumbTitle').html(result.schemeName);
				$.each( result.allOfftrackOutputIndicators, function( key, value ) {
					
					$.each( value, function( key2, value2 ) {
					var htm = '<a href="output-target-baseline.html?indicator_id='+value2.id +'">' + value2.name + '</a>';
					$('#indicatorsScrollOfftrack').append(htm);
					});
				});
				$.each( result.allOfftrackOutcomeIndicators, function( key, value ) {
					$.each( value, function( key2, value2 ) {
						var htm = '<a href="outcome-target-baseline.html?indicator_id='+value2.id +'">' + value2.name + '</a>';
						$('#indicatorsScrollOfftrack').append(htm);
					});
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

	$.ajax({async: true,
			url: siteUrl + "/api/get_chart_data_scheme",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			data:{'scheme_id':scheme_id},
			type: 'get',
			success: function(result){
				console.log(result);
				var lables = result.lables;
				var totalIndicators =  result.totalIndicators;
				var totalNa =  result.totalNa;
				var ontrack =  result.ontrack;
				var offtrack =  result.offtrack;
				var inprogress =  result.inprogress;

				var barChartData = {
		labels: lables,
		datasets: [
		{
			label: 'Total Indicators',
			backgroundColor: '#6181a2',
			stack: 'Stack 0',
			data: totalIndicators
		},
		{
			label: 'Not Reported',
			backgroundColor: '#999',
			stack: 'Stack 1',
			data: totalNa
		},
		
		{
			label: 'On Track',
			backgroundColor: '#37942c',
			stack: 'Stack 2',
			data: ontrack
		},
		{
			label: 'Off Track',
			backgroundColor: '#B70000',
			stack: 'Stack 3',
			data: offtrack
		},
		{
			label: 'Not Applicable',
			backgroundColor: '#FFFF00',
			stack: 'Stack 4',
			data: inprogress
		},

		]

	};
	drawBarChart('myChart', barChartData, 20);

	var i=0;
	$.each( result.departments, function( key, value ) {
	   ++i;
		if(i%3==0){
			var cls = "right";
		}
		else{
			var cls = "";
		}
	   console.log(value);
	   
	   	var sector = value;
	   	var htm = '<div class="col-md-4"><div class="dash-sec-thumb '+cls+'"><a class="anch" data-target="#chartDrop_'+sector.id+'"><div class="title">'+sector.name+'</div><div class="thumb-ind-wrap"><span class="thumb-ind-item">'+result.xtotalNa[sector.id]+'</span><span class="thumb-ind-item green">'+result.xontrack[sector.id]+'</span><span class="thumb-ind-item red">'+result.xofftrack[sector.id]+'</span><span class="thumb-ind-item yellow">'+result.xinprogress[sector.id]+'</span></div></a><div class="sub-anchor-drop"><div class="sub-anchor-drop-in"><a href="scheme_dashboard.html?scheme_id='+sector.id+'">View Scheme Details</a></div></div><div class="dash-sec-thumb-dets" id="chartDrop_'+sector.id+'"><canvas id="chartCan_'+sector.id+'" width="500"></canvas></div></div></div>';
		var htm2 = '';
		$('#sectorDashList').append(htm);
		$('#chartSectContainer').append(htm2);
		includeHTML();
		data = {
		    datasets: [{
		        data: [result.xontrack[sector.id],result.xofftrack[sector.id],result.xinprogress[sector.id],result.xtotalNa[sector.id]],
		        backgroundColor:['#37942c', '#FF8300', '#FFFF00','#9b9bde']
		    }],

		    labels: [
		        'on track',
		        'off track',
		        'in progress',
		        'NA'
		    ]
		};
		drawPieChart('chartCan_'+sector.id, data);
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

	$.ajax({async: true,
		url: siteUrl + "/api/get_dashboard_counts_scheme_critical",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		data:{'scheme_id':scheme_id},
		type: 'get',
		success: function(result){
			console.log(result);
			// $('.total-schemes1 .value').html(result.schemesCount);
			$('.total-indicators1 .value').html(result.indicatorsCount);
			$('.on-track1 .value').html(result.ontrack);
			$('.off-track1 .value').html(result.offtrack);
			$('.inprogress1 .value').html(result.inProgess);
			$('.notapplicable1 .value').html(result.na);
			// $('#dashSecThumbTitle').html(result.department.name);

			$.each( result.allOfftrackOutputIndicators, function( key, value ) {
				// console.log(value.id);
				var htm = '<a href="output-target-baseline.html?indicator_id='+value[0].id +'">' + value[0].name + '</a>';
				$('#indicatorsScrollOfftrackCri').append(htm);
			});
			$.each( result.allOfftrackOutcomeIndicators, function( key1, value1 ) {
				var htm = '<a href="outcome-target-baseline.html?indicator_id='+value1[0].id +'">' + value1[0].name + '</a>';
				$('#indicatorsScrollOfftrackCri').append(htm);
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




	$.ajax({async: true,
			url: siteUrl + "/api/get_chart_data_scheme_critical",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			data:{'scheme_id':scheme_id},
			type: 'get',
			success: function(result){
				console.log(result);
				var lables = result.lables;
				var totalIndicators =  result.totalIndicators;
				var totalNa =  result.totalNa;
				var ontrack =  result.ontrack;
				var offtrack =  result.offtrack;
				var inprogress =  result.inprogress;

				var barChartData = {
		labels: lables,
		datasets: [
		{
			label: 'Total Indicators',
			backgroundColor: '#2A3F54',
			stack: 'Stack 0',
			data: totalIndicators
		},
		{
			label: 'Not Reported',
			backgroundColor: '#999',
			stack: 'Stack 1',
			data: totalNa
		},
		
		{
			label: 'On Track',
			backgroundColor: '#37942c',
			stack: 'Stack 2',
			data: ontrack
		},
		{
			label: 'Off Track',
			backgroundColor: '#B70000',
			stack: 'Stack 3',
			data: offtrack
		},
		{
			label: 'Not Applicable',
			backgroundColor: '#FFFF00',
			stack: 'Stack 4',
			data: inprogress
		},

		]

	};

	drawBarChart('myChart6', barChartData, 20);

	var i=0;
	$.each( result.departments, function( key, value ) {
	   ++i;
		if(i%3 == 0){
			var cls = "right";
		}
		else{
			var cls = "";
		}
	   console.log(value);
	   
	   	var sector = value;
	   	var htm = '<div class="col-md-4"><div class="dash-sec-thumb '+cls+'"><a class="anch" data-target="#chartDrop7_'+sector.id+'"><div class="title">'+sector.name+'</div><div class="thumb-ind-wrap"><span class="thumb-ind-item">'+result.xtotalNa[sector.id]+'</span><span class="thumb-ind-item green">'+result.xontrack[sector.id]+'</span><span class="thumb-ind-item red">'+result.xofftrack[sector.id]+'</span><span class="thumb-ind-item yellow">'+result.xinprogress[sector.id]+'</span></div></a><div class="sub-anchor-drop"><div class="sub-anchor-drop-in"><a href="scheme_dasboard.html?sector_id='+sector.id+'">View Scheme Details</a></div></div><div class="dash-sec-thumb-dets" id="chartDrop7_'+sector.id+'"><canvas id="chartCan7_'+sector.id+'" width="500"></canvas></div></div></div>';
		var htm2 = '';
		$('#sectorDashList7').append(htm);
		// $('#chartSectContainer').append(htm2);
		includeHTML();
		data = {
		    datasets: [{
		        data: [result.xontrack[sector.id],result.xofftrack[sector.id],result.xinprogress[sector.id],result.xtotalNa[sector.id]],
		        backgroundColor:['#37942c', '#FF8300', '#FFFF00','#9b9bde']
		    }],

		    labels: [
		        'on track',
		        'off track',
		        'Not Applicable',
		        'Not Reported'
		    ]
		};
		drawPieChart('chartCan7_'+sector.id, data);
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

});

function drawBarChart(target, barChartData, yGap){

	var ctx1 = document.getElementById(target).getContext('2d');
	
	window.myBar = new Chart(ctx1, {
		type: 'bar',
		data: barChartData,
		options: {
			defaultFontSize: 12,
			showTooltips: true,
			legend: {
            	display: true,
            	position: 'bottom',
            	labels: {
            		// fontColor: '#777',
            		padding: 10,
            		fontSize: 12,
            	}
        	},
			title: {
				display: false,
				text: 'Progress Indicators'
			},
			tooltips: {
				enabled: true,
				mode: 'index',
				intersect: false
			},
			responsive: true,
			scales: {
				xAxes: [{
					barPercentage: 0.5,
					stacked: true,
					gridLines: {
						display: false,
	                    color: "#AAA",
	                    borderDash: [2,2],
	                },
	                ticks: {
		                fontSize: 10,
	                    // maxRotation: 90,
	                    // minRotation: 90,

		            },
		            scaleLabel: {
				        display: true,
				        fontSize: 20,
				        // labelString: 'Delhi Government'
			      	}
				}],
				yAxes: [{
					stacked: true,
					gridLines: {
	                    color: "#AAA",
	                    borderDash: [2,2],
	                },
			      	ticks: {
			        	stepSize: yGap,
			        	beginAtZero: true,
      					padding: 25,
			      	},
		            scaleLabel: {
				        display: true,
				        fontSize: 12,
				        // labelString: '(In numbers)'
			      	}
				}]
			}
		}
	});
}

function drawPieChart(target, data){
	var ctx = document.getElementById(target).getContext('2d');
	var myPieChart = new Chart(ctx,{
	    type: 'pie',
	    data: data,
	    options: {
	    	legend: {
	    		position: 'bottom'
	    	},
        	pieceLabel: {
			    render: 'percentage',
			    fontColor: '#FFF',
			    precision: 2
		  	},
			showTooltips: true,
	    	cutoutPercentage: 0
	    }
	});
}

function drawDonutChart(target, data){
	var ctx3 = document.getElementById(target).getContext('2d');
	var myPieChart = new Chart(ctx3,{
	    type: 'doughnut',
	    data: data,
	    options: {
	    	legend: {
	    		position: 'bottom'
	    	},
        	pieceLabel: {
			    render: 'percentage',
			    fontColor: '#FFF',
			    precision: 2
		  	},
			tooltips: {
				mode: 'index',
				intersect: false
			}
	    }
	});
}


function drawPolarChart(target, data){
	var ctx2 = document.getElementById(target).getContext('2d');
	var myPieChart = new Chart(ctx2,{
	    type: 'polarArea',
	    data: data,
	    options: {
	    	legend: {
	    		position: 'bottom'
	    	},
        	pieceLabel: {
			    render: 'percentage',
			    fontColor: '#FFF',
			    precision: 2
		  	},
			showTooltips: true,
			tooltips: {
				mode: 'index',
				intersect: false
			}
	    }
	});
}

$.date = function(orginaldate) { 
    var date = new Date(orginaldate);
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    if (day < 10) {
        day = "0" + day;
    }
    if (month < 10) {
        month = "0" + month;
    }
    var date =  month + "/" + day + "/" + year; 
    return date;
};