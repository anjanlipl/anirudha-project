$(document).ready(function(){
	
	checkSuperAdmin();
	var urlParams = new URLSearchParams(window.location.search);
	var sector_id = urlParams.get('sector_id');

	$(".dept_spec").each(function() {
	   	var $this = $(this);       
	   	var _href = $this.attr("href"); 
	   	$this.attr("href", _href + '?sector_id=' + sector_id);
	});


	Chart.plugins.register({
	  beforeDraw: function(chartInstance) {
	    var ctx = chartInstance.chart.ctx;
	    ctx.fillStyle = "rgba(255, 255, 255, 0)";
	    ctx.fillRect(0, 0, chartInstance.chart.width, chartInstance.chart.height);
	  }
	});
Chart.defaults.global.defaultFontColor = '#000';
Chart.defaults.global.legend.labels.usePointStyle = true;
$.ajax({async: true,
  	url: siteUrl + "/api/actionpoint_sector",
  	headers: {
    	'Accept': 'application/json',
    	'Authorization': 'Bearer ' + localStorage.token
  	},
  	data:{'sector_id':sector_id},
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
			url: siteUrl + "/api/get_dashboard_sector_financials",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			data:{'sector_id':sector_id},
			type: 'get',
			success: function(result){
				console.log(result);
				// $('.total-schemes .value').html(result.schemesCount);
				$('.total-estimate .value').html(result.totalEst);
				$('.total-exp .value').html(result.totalExp);
				$('.month-exp .value').html(result.current_month_exp);
				// var per = 'NA';
				per = Math.round((result.totalExp/result.totalEst)*100);
				// console.log('per = ' +per);
				if(isNaN(per)){
					per = 'NA';
				}
				$('.perc-exp .value').html(per);
				// $('.inprogress .value').html(result.inProgess);
				// $('.notapplicable .value').html(result.na);

				var ctx = document.getElementById('myPieChart2').getContext('2d');
				data = {
				    datasets: [{
				        data: [result.totalEst, result.totalExp, result.current_month_exp],
				        backgroundColor:['#6181a2', '#37942c', '#FFFF00']
				    }],
				    labels: [
				        'Total Allocation(B.E. - Rupees in Croress)',
				        'TOTAL EXPENDITURE(Rupees in Croress)',
				        'Current Month Expenditure',
				        // 'NA'
				    ]
				};
				drawPieChart('myPieChart2', data);
				drawPolarChart('myPolarChart2', data);
				drawDonutChart('myDoughnutChart2', data);
				var barChartData = {
					labels: [result.sector_name],
					datasets: [
						{
							label: 'Total Allocation(B.E. - Rupees in Croress)',
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

				drawBarChart('myChart2', barChartData, 100000);
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
		url: siteUrl + "/api/get_chart_data_sector_Establishment",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		type: 'get',
		data:{'sector_id':sector_id},
		success: function(result){
			console.log(result);

			// myChartEst
			data = {
			    datasets: [{
			        data: [result.totalSchemeExp, result.totalExp],
			        backgroundColor:['#FF8300', '#FFFF00']
			    }],
			    labels: [
			        'Total Scheme Expenditure',
			        'Total Est. Expenditure',
			        // 'NA'
			    ]
			};
			drawPieChart('myChartEst', data);
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
			url: siteUrl + "/api/get_dashboard_sector_financials_deptwise",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			data:{'sector_id':sector_id},
			type: 'get',
			success: function(result){
				// console.log(result);
				var i=0;
				$.each( result.departments, function( key, value ) {
					++i;
					if(i==4){
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

				   	var htm = '<div class="col-md-3 dash-sec-thumb-main" data-perf="'+perf+'"><div class="dash-sec-thumb '+cls+'"><a class="anch" data-target="#chartDrop2_'+key+'"><div class="title">'+sector.name+'</div><div class="thumb-ind-wrap"><span class="thumb-ind-item">'+result.totalEst[key]+'</span><span class="thumb-ind-item green">'+result.totalExp[key]+'</span></div></a><span class="sub-anchor" w3-include-html="assets/icons/dots.html"></span><div class="sub-anchor-drop"><div class="sub-anchor-drop-in"><a href="dept_dashboard.html?dept_id='+sector.id+'">Departments</a></div></div><div class="dash-sec-thumb-dets" id="chartDrop2_'+key+'"><canvas id="chartCan2_'+key+'" width="500"></canvas></div></div></div>';
					$('#sectorDashList1').append(htm);
					includeHTML();
					data = {
					    datasets: [{
					        data: [result.totalEst[key],result.totalExp[key]],
					        backgroundColor:['#37942c', '#FF8300']
					    }],

					    labels: [
					        'Estimate',
					        'Expenditure'
					    ]
					};
					drawPieChart('chartCan2_'+key, data);
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
			url: siteUrl + "/api/get_dashboard_counts_sector",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			data:{'sector_id':sector_id},
			type: 'get',
			success: function(result){
				console.log(result);
				$('.total-schemes .value').html(result.schemesCount);
				$('.total-indicators .value').html(result.indicatorsCount);
				$('.on-track .value').html(result.ontrack);
				$('.off-track .value').html(result.offtrack);
				$('.inprogress .value').html(result.inProgess);
				$('.notapplicable .value').html(result.na);
				$('#dashSecThumbTitle').html("Sector: "+result.sector.name);
					
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
			url: siteUrl + "/api/get_chart_data_alldeptmain",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			data:{'sector_id':sector_id},
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
						// {
						// 	label: 'Total Indicators',
						// 	backgroundColor: '#2A3F54',
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
							backgroundColor: '#37942c',
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
				drawBarChartStacked('myChart', barChartData, 20);
				var i=0;
				console.log(result.departments);
				$.each( result.departments[0], function( key, value ) {
					console.log('Hello');
				   ++i;
					if(i==4){
						var cls = "right";
					}
					else{
						var cls = "";
					}
				//    console.log(value.length);
				//    if(value.length > 0){
				   	var sector = value;
				   var total_ind = result.xontrack[sector.id] + result.xtotalNa[sector.id] + result.xofftrack[sector.id] + result.xinprogress[sector.id];
				   var total_on = result.xontrack[sector.id];
				   var perf = total_on / total_ind;
				   if (!isFinite(perf))
					{
					    // ...
					    perf = 0;
					}
				   

				   var htm = '<div class="col-md-3 dash-sec-thumb-main" data-perf="'+perf+'"><div class="dash-sec-thumb '+cls+'"><a class="anch" data-target="#chartDrop_'+sector.id+'"><div class="title">'+sector.name+'</div><div class="thumb-ind-wrap"><span class="thumb-ind-item">'+result.xtotalNa[sector.id]+'</span><span class="thumb-ind-item green">'+result.xontrack[sector.id]+'</span><span class="thumb-ind-item red">'+result.xofftrack[sector.id]+'</span><span class="thumb-ind-item yellow">'+result.xinprogress[sector.id]+'</span></div></a><span class="sub-anchor" w3-include-html="assets/icons/dots.html"></span><div class="sub-anchor-drop"><div class="sub-anchor-drop-in"><a href="dept_dashboard.html?dept_id='+sector.id+'">Schemes</a></div></div><div class="dash-sec-thumb-dets" id="chartDrop_'+sector.id+'"><canvas id="chartCan_'+sector.id+'" width="500"></canvas></div></div></div>';
					
					var htm2 = '';
					$('#sectorDashList').append(htm);
					// $('#chartSectContainer, #chartSectContainer1').append(htm2);
					includeHTML();
					data = {
					    datasets: [{
					        data: [result.xontrack[sector.id],result.xofftrack[sector.id],result.xinprogress[sector.id],result.xtotalNa[sector.id]],
					        backgroundColor:['#37942c', '#FF8300', '#FFFF00','#999']
					    }],

					    labels: [
					        'on track',
					        'off track',
					        'Not Applicable',
					        'Not Reported'
					    ]
					};
					drawPieChart('chartCan_'+sector.id, data);
					// }

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


	// var ctx = document.getElementById('myPieChart').getContext('2d');
	// data = {
	//     datasets: [{
	//         data: [10, 4, 8, 3],
	//         backgroundColor:['#37942c', '#FF8300', '#FFFF00','#9b9bde']
	//     }],

	//     labels: [
	//         'on track',
	//         'off track',
	//         'in progress',
	//         'NA'
	//     ]
	// };
	// var myPieChart = new Chart(ctx,{
	//     type: 'pie',
	//     data: data,
	//     options: {
	//     	legend: {
	//     		position: 'right'
	//     	},
	//     	cutoutPercentage: 0
	//     }
	// });


	$.ajax({async: true,
		url: siteUrl + "/api/get_dashboard_counts_sector_critical",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		data:{'sector_id':sector_id},
		type: 'get',
		success: function(result){
			console.log(result);
			$('.total-schemes1 .value').html(result.schemesCount);
			$('.total-indicators1 .value').html(result.indicatorsCount);
			$('.on-track1 .value').html(result.ontrack);
			$('.off-track1 .value').html(result.offtrack);
			$('.inprogress1 .value').html(result.inProgess);
			$('.notapplicable1 .value').html(result.na);
			$('#dashSecThumbTitle').html("Sector:" +result.sector.name);
				
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


	$.ajax({async: true,
			url: siteUrl + "/api/get_chart_data_alldeptmain",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			data:{'sector_id':sector_id},
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
							stack: 'Stack 0',
							data: totalNa
						},
						
						{
							label: 'On Track',
							backgroundColor: '#37942c',
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
				drawBarChartStacked('myChart6', barChartData, 20);
				var i=0;
				$.each( result.departments, function( key, value ) {
				   ++i;
					if(i==4){
						var cls = "right";
					}
					else{
						var cls = "";
					}
				   console.log(value.length);
				   if(value.length > 0){
				   	var sector = value[0];
				   var total_ind = result.xontrack[sector.id] + result.xtotalNa[sector.id] + result.xofftrack[sector.id] + result.xinprogress[sector.id];
				   var total_on = result.xontrack[sector.id];
				   var perf = total_on / total_ind;
				   if (isFinite(perf))
					{
					    // ...
					    perf = 0;
					}
				   
				   	
				   var htm = '<div class="col-md-3 dash-sec-thumb-main" data-perf="'+perf+'"><div class="dash-sec-thumb '+cls+'"><a class="anch" data-target="#chartDrop6_'+sector.id+'"><div class="title">'+sector.name+'</div><div class="thumb-ind-wrap"><span class="thumb-ind-item">'+result.xtotalNa[sector.id]+'</span><span class="thumb-ind-item green">'+result.xontrack[sector.id]+'</span><span class="thumb-ind-item red">'+result.xofftrack[sector.id]+'</span><span class="thumb-ind-item yellow">'+result.xinprogress[sector.id]+'</span></div></a><span class="sub-anchor" w3-include-html="assets/icons/dots.html"></span><div class="sub-anchor-drop"><div class="sub-anchor-drop-in"><a href="dept_dashboard.html?dept_id='+sector.id+'">Schemes</a></div></div><div class="dash-sec-thumb-dets" id="chartDrop6_'+sector.id+'"><canvas id="chartCan6_'+sector.id+'" width="500"></canvas></div></div></div>';
					
					var htm2 = '';
					$('#sectorDashList6').append(htm);
					// $('#chartSectContainer, #chartSectContainer1').append(htm2);
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

					drawPieChart('chartCan6_'+sector.id, data);

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














 $(document).on('click', '#showSchemePage', function(event){
 	event.preventDefault();
		window.location.href= "scheme-list-dept.html?sector_id="+ sector_id;

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
		});



});

function drawBarChartStacked(target, barChartData, yGap){

	var ctx1 = document.getElementById(target).getContext('2d');
	
	console.log(barChartData);

	window.myBar = new Chart(ctx1, {
		type: 'horizontalBar',
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
			responsive: false,
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
				        // labelString: 'Departments'
			      	}
				}]
			}
		}
	});
}

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
	// var ctx = document.getElementById(target).getContext('2d');
	// var myPieChart = new Chart(ctx,{
	//     type: 'pie',
	//     data: data,
	//     options: {
	//     	legend: {
	//     		position: 'bottom'
	//     	},
 //        	pieceLabel: {
	// 		    render: 'percentage',
	// 		    fontColor: '#FFF',
	// 		    precision: 2
	// 	  	},
	// 		showTooltips: true,
	//     	cutoutPercentage: 0
	//     }
	// });
}

function drawDonutChart(target, data){
	// var ctx3 = document.getElementById(target).getContext('2d');
	// var myPieChart = new Chart(ctx3,{
	//     type: 'doughnut',
	//     data: data,
	//     options: {
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


function drawPolarChart(target, data){
	// var ctx2 = document.getElementById(target).getContext('2d');
	// var myPieChart = new Chart(ctx2,{
	//     type: 'polarArea',
	//     data: data,
	//     options: {
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