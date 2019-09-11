$(document).ready(function(){

	checkDadminOrHOD();
	var urlParams = new URLSearchParams(window.location.search);
	var objective_id = urlParams.get('objective_id');
	$('#objective-bread').attr('href','scheme-objectives.html?')


	if(objective_id == null){
		// alert('abc');
		$('#addBtn, .head-info').hide();
	}
	else{
		$.ajax({async: true,
			url: siteUrl + "/api/outputs_head_info",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			data: {'objective_id': objective_id},
			type: 'GET',
			success: function(result){
				$('.head-info').html(result.headInfo);
				$('.objectiveBread').attr('href','scheme-objectives.html?scheme_id=' + $( '.schemeinfo').attr('data-id'));
				
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

	$.ajax({async: true,
		url: siteUrl + "/api/outputs_list",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		data: {'objective_id': objective_id},
		success: function(result){
			$('#schemeObjectivesOutput').DataTable({
				data: result.outputs
			});
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
					.append('<li value="" class="init" selected="selected" disabled="disabled">Select an Objective</li>');
				if (result.objectives.length > 0) {
					$.each(result.objectives, function(k, val){
						var newOption = $('<li  value="'+val.id+'">'+val.description+'</li>');
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

	$('#scheme-objective-output-add').on('submit', function(e){
		e.preventDefault();
        if($.validatr.validateForm($('#scheme-objective-output-add'))){
			var form_data = $(this).serialize() + '&objective_id=' + objective_id;
			$.ajax({async: true,
				url: siteUrl + "/api/add_scheme_objective_output",
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

	
	 $(document).on('click', '.editoutput', function(){
      var outId = $(this).attr('data-id');
      var desc = $(this).attr('data-name');

      			$('#scheme-objective-output-edit .id').val(outId);
				$('#scheme-objective-output-edit .output_name').val(desc);
 		 });


	 $('#scheme-objective-output-edit').on('submit', function(e){
		e.preventDefault();
        if($.validatr.validateForm($('#scheme-objective-output-edit'))){
			var form_data = $(this).serialize();
			$.ajax({async: true,
				url: siteUrl + "/api/edit_scheme_objective_output",
				headers: {
					'Accept': 'application/json',
					'Authorization': 'Bearer ' + localStorage.token
				},
				type: 'POST',
				data: form_data,
				success: function(result){
					alert('successfully updated');
					location.reload();
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
		}
	});

	  $(document).on('click', '.deleteOut', function(){
	var id = $(this).attr('data-id');
	if(confirm("Are you sure to delete?")){
		
		$.ajax({async: true,
                      url: siteUrl + "/api/deleteOutput/" + id,
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

$("#objective-select").on("click", ".init", function() {
	    $(this).closest("#objective-select").children('li:not(.init)').toggle();
	});

	var allOptions = $("#objective-selectt").children('li:not(.init)');
	$("#objective-select").on("click", "li:not(.init)", function() {
	    allOptions.removeClass('selected');
	    $(this).addClass('selected');
	    $("#objective-select").children('.init').html($(this).html());
	    allOptions.toggle();
	});	


});
$(document).ready(function() {

	});