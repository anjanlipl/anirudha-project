$(document).ready(function(){

		var urlParams = new URLSearchParams(window.location.search);
		var dept_id = urlParams.get('dept_id');
		// alert(dept_id);
		if(dept_id == undefined || dept_id == null || dept_id == ''){
			var url = siteUrl + "/api/get_schemes_home";
		}else{
			var url = siteUrl + "/api/get_schemes_home/" + dept_id;
		}

		$.ajax({async: true,
			url: url,
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			type: 'get',
			success: function(result){
				console.log(result);
					var i=0;
					$.each( result.schemes, function( key, value ) {
						++i;
					if(i==4){
						var cls = "right";
					}
					else{
						var cls = "";
					}
				   var sector = value;
				   //alert(sector.name);

				   var htm = '<div class="col-md-3"><div class="dash-sec-thumb '+cls+'"><a class="anch" data-target="#chartDrop_'+sector.id+'"><div class="title">'+sector.name+'</div><div class="thumb-ind-wrap"><span class="thumb-ind-item">'+result.xtotalNa[sector.id]+'</span><span class="thumb-ind-item green">'+result.xontrack[sector.id]+'</span><span class="thumb-ind-item red">'+result.xofftrack[sector.id]+'</span><span class="thumb-ind-item yellow">'+result.xinprogress[sector.id]+'</span></div></a><span class="sub-anchor" w3-include-html="assets/icons/dots.html"></span><div class="sub-anchor-drop"><div class="sub-anchor-drop-in"><a href="scheme_dashboard.html?scheme_id='+sector.id+'">View Scheme Details</a></div></div><div class="dash-sec-thumb-dets" id="chartDrop_'+sector.id+'"><canvas id="chartCan_'+sector.id+'" width="500"></canvas></div></div></div>';
					
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