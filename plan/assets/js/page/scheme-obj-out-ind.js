$(document).ready(function(){

	checkDadminOrHOD();
	var urlParams = new URLSearchParams(window.location.search);
	var output_id = urlParams.get('output_id');
	// alert(output_id);
	if(output_id == null){
		// alert('abc');
		$('#addBtn, .head-info').hide();
	}
	else{
		$.ajax({async: true,
			url: siteUrl + "/api/outcomes_head_info",
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
	}


	$.ajax({async: true,
		url: siteUrl + "/api/departmentlist",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		type: 'POST',
		success: function(result){
			$('#dept-select')
				.empty()
				.append('<option value="" selected="selected" disabled="disabled">Select a Department</option>');
			if (result.departments.length > 0) {
				$.each(result.departments, function(k, val){
					var newOption = $('<option value="'+val.id+'">'+val.name+'</option>');
					$('#dept-select').append(newOption);
				});
			}
			// $('#dept-select').trigger('change');
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});

	

	$('#dept-select').on('change', function(){
		var dept_id = $(this).val();

		var data = {
			'dept_id': dept_id
		};
		$.ajax({async: true,
			url: siteUrl + "/api/getdepartmentschemes",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			type: 'POST',
			data: data,
			success: function(result){
				// alert(result);
				$('#scheme-select')
					.empty()
					.append('<option value="" selected="selected" disabled="disabled">Select a Scheme</option>');
				if (result.schemes.length > 0) {
					$.each(result.schemes, function(k, val){
						var newOption = $('<option value="'+val.id+'">'+val.name+'</option>');
						$('#scheme-select').append(newOption);
					});
				}
				// $('#dept-select').trigger('change');
				// location.reload();
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

	$('#scheme-select').on('change', function(){
		var scheme_id = $(this).val();

		var data = {
			'scheme_id': scheme_id
		};
		$.ajax({async: true,
			url: siteUrl + "/api/getschemeobjective",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			type: 'POST',
			data: data,
			success: function(result){
				// alert(result);
				$('#objective-select')
					.empty()
					.append('<option value="" selected="selected" disabled="disabled">Select an Objective</option>');
				if (result.objectives.length > 0) {
					$.each(result.objectives, function(k, val){
						var newOption = $('<option value="'+val.id+'">'+val.description+'</option>');
						$('#objective-select').append(newOption);
					});
				}
				// $('#dept-select').trigger('change');
				// location.reload();
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

	$('#objective-select').on('change', function(){
		var objective_id = $(this).val();

		var data = {
			'objective_id': objective_id
		};
		$.ajax({async: true,
			url: siteUrl + "/api/getobjectiveoutput",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			type: 'POST',
			data: data,
			success: function(result){
				// alert(result);
				$('#output-select')
					.empty()
					.append('<option value="" selected="selected" disabled="disabled">Select an Output</option>');
				if (result.outputs.length > 0) {
					$.each(result.outputs, function(k, val){
						var newOption = $('<option value="'+val.id+'">'+val.name+'</option>');
						$('#output-select').append(newOption);
					});
				}
				// $('#dept-select').trigger('change');
				// location.reload();
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



	$.ajax({async: true,
		url: siteUrl + "/api/outcomes_list",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		data: {'output_id': output_id},
		type: 'GET',
		success: function(result){
			$('#outcomeTab').DataTable({
				data: result.outcomes
			});
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});

	$('#outcome-add').on('submit', function(e){
		e.preventDefault();
        if($.validatr.validateForm($('#outcome-add'))){
			var form_data = $(this).serialize() + '&output_id=' + output_id;
			$.ajax({async: true,
				url: siteUrl + "/api/add_outcome",
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

	 $(document).on('click', '.editoutcome', function(){

      var outId = $(this).attr('data-id');
      var desc = $(this).attr('data-name');
           	$('#outcome-edit .outcome_id').val(outId);
				$('#outcome-edit .outcome_name').val(desc);
 		 });


	 $('#outcome-edit').on('submit', function(e){
		e.preventDefault();
        if($.validatr.validateForm($('#outcome-edit'))){
			var form_data = $(this).serialize();
			$.ajax({async: true,
				url: siteUrl + "/api/update_outcome",
				headers: {
					'Accept': 'application/json',
					'Authorization': 'Bearer ' + localStorage.token
				},
				type: 'POST',
				data: form_data,
				success: function(result){
					alert('updated successfullfy');
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

	 $(document).on('click', '.deleteOut', function(){
	var id = $(this).attr('data-id');
	if(confirm("Are you sure to delete?")){
		
		$.ajax({async: true,
                      url: siteUrl + "/api/deleteOutcome/" + id,
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