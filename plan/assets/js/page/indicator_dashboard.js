$(document).ready(function(){

	
checkDadminOrHOD();
	var urlParams = new URLSearchParams(window.location.search);
	var indicator_type = urlParams.get('type');
	var indicator_id = urlParams.get('id');
	$.ajax({async: true,
  	url: siteUrl + "/api/indicator_data_main",
  	headers: {
    	'Accept': 'application/json',
    	'Authorization': 'Bearer ' + localStorage.token
  	},
  	data:{'indicator_type':indicator_type,'indicator_id':indicator_id},
  	success: function(result){
      //console.log(result);
      $('#dashSecThumbTitle').html(result.indicator_name);
  		
  		$('.total-schemes .value ').html(result.indicator_type);
  		$('.total-indicators .value ').html(result.status);
      if(result.baseline != null){
           $('.on-track .value ').html(result.baseline.value);
      }else{
        $('.on-track .value ').html('NA');
      }
      if(result.target != null ){
          $('.off-track .value ').html(result.target.value);    
      }else{
          $('.off-track .value ').html('NA');    

      }
      if(result.achievement != null ){
          $('.inprogress .value ').html(result.achievement);
      }else{
          $('.inprogress .value ').html('NA');

      }

  			
		    $('#actionsTab').DataTable({
 	        data: result.actionpoints
        });

       $('#indicator_name').html(result.indicator.name);
       $('#critical').html((result.indicator.is_critical == 1)?"Yes":"No");
       $('#created_at').html(result.indicator.created_at);
       $('#updated_at').html(result.indicator.updated_at);
  		
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
});
