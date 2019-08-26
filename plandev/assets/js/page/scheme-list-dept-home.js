$(document).ready(function(){
	
	var urlParams = new URLSearchParams(window.location.search);
	var sector_id = urlParams.get('sector_id');
		$.ajax({
			async: true,
			url: siteUrl + "/api/get_dashboard_counts_sector",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			data:{'sector_id':sector_id},
			type: 'get',
			success: function(result){
			
				$('#dashSecThumbTitle').html(result.sector.name);

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
			url: siteUrl + "/api/get_schemes_dept_home",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			data:{'sector_id':sector_id},
			type: 'get',
			success: function(result){
				console.log(result);
					$.each( result.schemes, function( key, value ) {
				   var sector = value;
				   //alert(sector.name);

				   var htm = '<div class="col-md-3"><div class="dash-sec-thumb"><a class="anch" data-target="#chartDrop_'+sector.id+'"><div class="title">'+sector.name+'</div><div class="thumb-ind-wrap"><span class="thumb-ind-item">'+result.xtotalNa[sector.id]+'</span><span class="thumb-ind-item green">'+result.xontrack[sector.id]+'</span><span class="thumb-ind-item red">'+result.xofftrack[sector.id]+'</span><span class="thumb-ind-item yellow">'+result.xinprogress[sector.id]+'</span></div></a><span class="sub-anchor" w3-include-html="assets/icons/dots.html"></span><div class="sub-anchor-drop"><div class="sub-anchor-drop-in"><a href="all_departments_dasboard.html?sector_id='+sector.id+'">Departments</a></div></div><div class="dash-sec-thumb-dets" id="chartDrop_'+sector.id+'"><canvas id="chartCan_'+sector.id+'" width="500"></canvas></div></div></div>';
					
					// var htm2 = '<div class="dash-sec-thumb-dets-in" id="chartDrop_'+sector.id+'"><canvas id="chartCan_'+sector.id+'" width="500"></canvas></div>';
					$('#sectorDashList').append(htm);
					// $('#chartSectContainer').append(htm2);
					includeHTML();
					var ctx = document.getElementById('chartCan_'+sector.id).getContext('2d');
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
						var myPieChart = new Chart(ctx,{
						    type: 'pie',
						    data: data,
						    options: {
						    	legend: {
						    		position: 'right'
						    	},
						    	cutoutPercentage: 0
						    }
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

});