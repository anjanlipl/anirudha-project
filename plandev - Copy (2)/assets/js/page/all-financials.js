$(document).ready(function(){
    $.ajax({async: true,
        url: siteUrl + "/api/get_dashboard_financials_sector",
        headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.token
        },
        type: 'get',
        success: function(result){
            
            // console.log(result);
            console.log(result);
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
                if(result.totalEst[key] > 0){
                    var htm = '<div class="col-md-4 dash-sec-thumb-main" data-perf="'+perf+'"><div class="dash-sec-thumb active"><div class="anch"><div class="title">'+sector.name+'</div></div><div class="dash-sec-thumb-dets" id="chartDrop2_'+key+'"><canvas id="chartCan2_'+key+'" width="500"></canvas></div><div class="thumb-ind-wrap"><div class="row"><div class="col-md-6"><div class="indi"><span class="thumb-ind-item">'+result.totalEst[key]+'</span> Allocations <span class="thumb-ind-item green">'+result.totalExp[key]+'</span></div></div><div class="col-md-6"><div class="sub-anchor-drop-in"><a href="dept_dashboard.html?dept_id='+sector.id+'">More</a></div></div></div></div><span class="sub-anchor"></span><div class="sub-anchor-drop"></div></div></div>';
                    $('#sectorDashList1').append(htm);
                    includeHTML();
                    data = {
                        datasets: [{
                            data: [result.totalEst[key],result.totalExp[key]],
                            backgroundColor:['#37942c', '#FF8300']
                        }],
        
                        labels: [
                            'Estimate ('+result.totalEst[key]+')',
                            'Expenditure ('+result.totalExp[key]+')'
                        ]
                    };
                    drawPieChart('chartCan2_'+key, data);
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