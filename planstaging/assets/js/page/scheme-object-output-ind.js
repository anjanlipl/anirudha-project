$(document).ready(function(){

	checkDadminOrHOD();
	var urlParams = new URLSearchParams(window.location.search);
	var output_id = urlParams.get('output_id');


	$.ajax({async: true,
		url: siteUrl + "/api/output_indicators_head_info",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		data: {'output_id': output_id},
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

	$.ajax({async: true,
		url: siteUrl + "/api/output_indicators_list",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		data: {'output_id': output_id},
		type: 'GET',
		success: function(result){
			console.log(result);
			$('#outputIndTab').DataTable({
				data: result.indicators,
				"columnDefs": [
				    { "visible": false, "targets": 0 }
			  	]
			});
			var headInfo = $('#head-info').data('schemename');
			$('.head-info').html(headInfo);
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
			}
		}
	});

	$('#scheme-output-ind').on('submit', function(e){
		e.preventDefault();
        if($.validatr.validateForm($('#scheme-output-ind'))){
			var form_data = $(this).serialize() + '&output_id=' + output_id;
			$.ajax({async: true,
				url: siteUrl + "/api/add_output_indicator",
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
      //alert(indId);
      var desc = $(this).attr('data-name');
      var remark = $(this).attr('data-remark');
           	$('#edit-output-ind .id').val(indId);
				$('#edit-output-ind .ind_name').val(desc);
				$('#edit-output-ind .remark').val(remark);
        $('#edit-output-ind #unit_id').val($(this).attr('data-unit'));

 		 });
	 $(document).on('click', '.indicatorObj', function(){
	 	//alert('here');
      var indId = $(this).attr('data-id');
      window.location = frontUrl +'indicator-objects.html?type=output&&indicator_id='+indId;

 		 });

	 $('#edit-output-ind').on('submit', function(e){
		e.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({async: true,
			url: siteUrl + "/api/edit_output_indicator",
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
	});
	 

	  $(document).on('click', '.deleteObj', function(){
	var id = $(this).attr('data-id');
	if(confirm("Are you sure to delete?")){
		
		$.ajax({async: true,
                      url: siteUrl + "/api/deleteOutputIndicator/" + id,
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

	   $(document).on('click', '.markCritical', function(){
	var id = $(this).attr('data-id');
	if(confirm("Are you sure?")){
		
		$.ajax({async: true,
                      url: siteUrl + "/api/mark_output_indicator_critical/" + id,
                      headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.token
                      },
                      type: "POST",
                      success: function(result) {

                            alert("Marked successfully !");
                           location.reload();
                          
                      }
                    });
	}
});


});