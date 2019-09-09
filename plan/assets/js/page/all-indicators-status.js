$(document).ready(function(){
    var urlParams = new URLSearchParams(window.location.search);
    var dept_id = urlParams.get('dept_id');
    var sector_id = urlParams.get('sector_id');
    var data = {
        status: '0',
        dept_id: dept_id,
        sector_id: sector_id
    };
    $.ajax({
        url: siteUrl + "/api/offtrackIndicators",                    
        type: 'POST',
        data: data,
        headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.token
        },
          success: function(result) {
              $('#allInds').html(result);
          }
      });



    $.ajax({async: true,
        url: siteUrl + "/api/get_chart_data_main",
        headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.token
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
                        label: 'NR (Not Reported)',
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
            var i = 0;
            $.each( result.sectors, function( key, value ) {

                if(dept_id != ''){
                    var sector = value;
                    if(sector.id == dept_id){
                        ++i;
                        if(i%3 == 0){
                            var cls = "right";
                        }
                        else{
                            var cls = "";
                        }
                        //alert(sector.name);
                        var total_ind = result.xontrack[sector.id] + result.xtotalNa[sector.id] + result.xofftrack[sector.id] + result.xinprogress[sector.id];
                        var total_on = result.xontrack[sector.id];
                        var perf = total_on / total_ind;
                        if (!isFinite(perf))
                        {
                            perf = 0;
                        }
                        var htm = '<div class="col-md-4 dash-sec-thumb-main" data-perf="'+perf+'"><div class="dash-sec-thumb '+cls+'"><a class="anch" data-target="#chartDrop_'+sector.id+'"><div class="title">'+sector.name+'</div><div class="thumb-ind-wrap"><span class="thumb-ind-item">'+result.xtotalNa[sector.id]+'</span> NR <span class="thumb-ind-item green">'+result.xontrack[sector.id]+'</span> On Track <span class="thumb-ind-item red">'+result.xofftrack[sector.id]+'</span> Off Track <span class="thumb-ind-item yellow">'+result.xinprogress[sector.id]+'</span> NA </div></a><span class="sub-anchor"></span><div class="sub-anchor-drop"><div class="sub-anchor-drop-in"><a href="dept_dashboard.html?dept_id='+sector.id+'">View Departments</a></div></div><div class="dash-sec-thumb-dets" id="chartDrop_'+sector.id+'"><canvas id="chartCan_'+sector.id+'" width="500"></canvas></div></div></div>';
                        $('#sectorDashList').append(htm);
                        includeHTML();
                        data = {
                            datasets: [{
                                data: [result.xontrack[sector.id],result.xofftrack[sector.id],result.xinprogress[sector.id],result.xtotalNa[sector.id]],
                                backgroundColor:['#37942c', '#FF8300', '#FFFF00','#9b9bde']
                            }],
                            labels: [
                                'On track ('+result.xontrack[sector.id]+')',
                                'Off track ('+result.xofftrack[sector.id]+')',
                                'Not Applicable ('+result.xinprogress[sector.id]+')',
                                'Not Reported ('+result.xtotalNa[sector.id]+')'
                            ]
                        };
                        if(!isNaN(sector.id)){
                            drawPieChart('chartCan_'+sector.id, data);
                        }
                    }
                }
                else{
                    ++i;
                    if(i%3 == 0){
                        var cls = "right";
                    }
                    else{
                        var cls = "";
                    }
                    var sector = value;
                    //alert(sector.name);
                    var total_ind = result.xontrack[sector.id] + result.xtotalNa[sector.id] + result.xofftrack[sector.id] + result.xinprogress[sector.id];
                    var total_on = result.xontrack[sector.id];
                    var perf = total_on / total_ind;
                    if (!isFinite(perf))
                    {
                        perf = 0;
                    }
                    var htm = '<div class="col-md-4 dash-sec-thumb-main" data-perf="'+perf+'"><div class="dash-sec-thumb '+cls+'"><a class="anch" data-target="#chartDrop_'+sector.id+'"><div class="title">'+sector.name+'</div><div class="thumb-ind-wrap"><span class="thumb-ind-item">'+result.xtotalNa[sector.id]+'</span> NR <span class="thumb-ind-item green">'+result.xontrack[sector.id]+'</span> On Track <span class="thumb-ind-item red">'+result.xofftrack[sector.id]+'</span> Off Track <span class="thumb-ind-item yellow">'+result.xinprogress[sector.id]+'</span> NA </div></a><span class="sub-anchor"></span><div class="sub-anchor-drop"><div class="sub-anchor-drop-in"><a href="dept_dashboard.html?dept_id='+sector.id+'">View Departments</a></div></div><div class="dash-sec-thumb-dets" id="chartDrop_'+sector.id+'"><canvas id="chartCan_'+sector.id+'" width="500"></canvas></div></div></div>';
                    $('#sectorDashList').append(htm);
                    includeHTML();
                    data = {
                        datasets: [{
                            data: [result.xontrack[sector.id],result.xofftrack[sector.id],result.xinprogress[sector.id],result.xtotalNa[sector.id]],
                            backgroundColor:['#37942c', '#FF8300', '#FFFF00','#9b9bde']
                        }],
                        labels: [
                            'On track ('+result.xontrack[sector.id]+')',
                            'Off track ('+result.xofftrack[sector.id]+')',
                            'Not Applicable ('+result.xinprogress[sector.id]+')',
                            'Not Reported ('+result.xtotalNa[sector.id]+')'
                        ]
                    };
                    if(!isNaN(sector.id)){
                        drawPieChart('chartCan_'+sector.id, data);
                    }
                }
            });
        },
        error:function (error) {
            if(error.status == 401){
                $('.error-content').html('');
                var errorMsg = '<div class="alert alert-danger">Unauthorized Access. Please re-try</div>';
                $('.error-content').append(errorMsg);
            } else if (error.status == 0) {
                $('.error-content').html('');
                var errorMsg = '<div class="alert alert-danger">Something went wrong.</div>';
                $('.error-content').append(errorMsg);
            }
        }
    });
});

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
			    fontColor: '#444',
			    position: 'outside',
			    textMargin: 10,
			    fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
			    fontSize: 17,
			    precision: 2
		  	},
			showTooltips: true,
	    	cutoutPercentage: 10
	    }
	});
}