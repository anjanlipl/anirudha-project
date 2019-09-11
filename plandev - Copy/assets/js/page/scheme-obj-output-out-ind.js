$(document).ready(function(){

	checkDadminOrHOD();
	var urlParams = new URLSearchParams(window.location.search);
	var outcome_id = urlParams.get('outcome_id');

	$.ajax({async: true,
		url: siteUrl + "/api/outcome_indicators_head_info",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		data: {'outcome_id': outcome_id},
		type: 'GET',
		success: function(result){
			$('.head-info').html(result.headInfo);
			$('.objectiveBread').attr('href','scheme-objectives.html?scheme_id=' + $( '.schemeinfo').attr('data-id'));
			$('.outputBread').attr('href',$('.outputBread').attr('href')+'?objective_id=' + $( '.objectiveinfo').attr('data-id'));
			$('.outcomeBread').attr('href',$('.outcomeBread').attr('href')+'?output_id=' + $( '.outputinfo').attr('data-id'));
			$('.IndicatorBread').attr('href',$('.IndicatorBread').attr('href')+'?outcome_id=' + $( '.outcomeinfo').attr('data-id'));
			
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});
	$.ajax({async: true,url: siteUrl + "/api/indicator_units_list",
        headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.token
      },
        success: function(result){
       var htm = '';
       $.each( result['indunits'], function( key, value ) {
        htm += '<option  value="'+result['indunits'][key]['id']+'" > '+ result['indunits'][key]['name'] +'</option>';
        //console.log( key + ": " + value );
      });
      $('.indicator_units_list').append(htm);
   }});

	$.ajax({
		async: true,
		type: 'POST',
		data: {'outcome_id': outcome_id},
		url: siteUrl + "/api/get_parent_output_indicators",
        headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.token
      },
        success: function(result){
        	console.log(result);
       var htm = '';
       $.each( result['inds'], function( key, value ) {
        htm += '<option  value="'+result['inds'][key]['id']+'" > '+ result['inds'][key]['name'] +'</option>';
        //console.log( key + ": " + value );
      });
      $('.output_indicator_list').append(htm);
   }});

	$.ajax({async: true,
		url: siteUrl + "/api/outcome_indicators_list",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		data: {'outcome_id': outcome_id},
		type: 'GET',
		success: function(result){
			$('#indicatorTab').DataTable({
				data: result.indicators,
				"columnDefs": [
				    { "visible": false, "targets": 0 }
			  	]
			});
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});
	$(document).on('click', '.indicatorObj', function(){
	 	//alert('here');
      var indId = $(this).attr('data-id');
      window.location = frontUrl +'indicator-objects.html?type=outcome&&indicator_id='+indId;

 		 });
	$('#scheme-indicator-add').on('submit', function(e){
		e.preventDefault();
        if($.validatr.validateForm($('#scheme-indicator-add'))){
			var form_data = $(this).serialize() + '&outcome_id=' + outcome_id;
			$.ajax({async: true,
				url: siteUrl + "/api/add_outcome_indicator",
				headers: {
					'Accept': 'application/json',
					'Authorization': 'Bearer ' + localStorage.token
				},
				type: 'POST',
				data: form_data,
				success: function(result){
					console.log(result);
					location.reload();
				},
				error:function (error) {
					if(error.status == 422){
						console.log(error);
						console.log(error.responseJSON.errors);
						// console.log(error['errors']);
	               		$.each(error.responseJSON.errors, function(key, value){
	               			$.notify(value, 'error');
	               		});
	                }
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
		}
	});

	$(document).on('click', '.editIndicator', function(){
	 	//alert('here');
      	var indId = $(this).attr('data-id');
      	var desc = $(this).attr('data-name');
      	var remark = $(this).attr('data-remark');
       	$('#edit-outcome-ind .id').val(indId);
		$('#edit-outcome-ind .ind_name').val(desc);
    	$('#edit-outcome-ind #unit_id').val($(this).attr('data-unit'));
		$('#edit-outcome-ind .remark').val(remark);

 		 });

	  $(document).on('click', '.markCritical', function(){
	var id = $(this).attr('data-id');
	if(confirm("Are you sure to mark it critical?")){
		
		$.ajax({async: true,
                      url: siteUrl + "/api/mark_outcome_indicator_critical/" + id,
                      headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.token
                      },
                      type: "POST",
                      success: function(result) {

                            alert("marked critical successfully !");
                           location.reload();
                          
                      }
                    });
	}
});

	 $('#edit-outcome-ind').on('submit', function(e){
		e.preventDefault();
        if($.validatr.validateForm($('#edit-outcome-ind'))){
			var form_data = $(this).serialize();
			$.ajax({async: true,
				url: siteUrl + "/api/edit_outcome_indicator",
				headers: {
					'Accept': 'application/json',
					'Authorization': 'Bearer ' + localStorage.token
				},
				type: 'POST',
				data: form_data,
				success: function(result){
					alert('Updated Successfully');
					location.reload();
				},
				error:function (error) {
					if(error.status == 422){
						console.log(error);
						console.log(error.responseJSON.errors);
						// console.log(error['errors']);
	               		$.each(error.responseJSON.errors, function(key, value){
	               			$.notify(value, 'error');
	               		});
	                }
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
		}
	});

	   $(document).on('click', '.deleteObj', function(){
	var id = $(this).attr('data-id');
	if(confirm("Are you sure to delete?")){
		
		$.ajax({async: true,
                      url: siteUrl + "/api/deleteOutcomeIndicator/" + id,
                      headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.token
                      },
                      type: "DELETE",
                      success: function(result) {
                          if(result['deleted'] == "true"){
                            alert("Deleted successfully !");
                           location.reload();
                          }
                      }
                    });
	}
});


});