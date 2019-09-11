$(document).ready(function(){

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
		$.notify('Loading Schemes', 'info');
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
				$('.notifyjs-wrapper').trigger('notify-hide');
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

$('#addToDashb').on('click', function(){
		var schemeExist ='false';
		var schemeId=  $('#scheme-select').val();
		var schemeName = $("#scheme-select option[value="+schemeId+"]").text();
		//alert(schemeName);
		if(schemeName !=  ''){

			$("#selectedSchemesInput :input").each(function(){
				 var input = $(this).val();
				 if(input == schemeId ){
				 	$.notify('Scheme Already Added to List.', 'error');
				 	schemeExist ='true';
				 }
				 
			});
			if(schemeExist == 'false' ){
				$('#selectedSchemesInput').append('<input type="hidden" name="scheme_ids[]" value="'+schemeId+'" />');

				$('#list-of-schemes').append('<li>'+schemeName+'</li>');
			}
			
		}
	
	});


	$('#compareSchemes').on('submit', function(e){
		$.notify('Loading Scheme Comparisions', 'info');
		//alert('here');
		e.preventDefault();
        //if($.validatr.validateForm($('#scheme-objective-output-add'))){
			var form_data = $(this).serialize();
			// alert(form_data);
			$.ajax({async: true,
				url: siteUrl + "/api/compareSchemes",
				headers: {
					'Accept': 'application/json',
					'Authorization': 'Bearer ' + localStorage.token
				},
				type: 'POST',
				data: form_data,
				success: function(result){
					$('.notifyjs-wrapper').trigger('notify-hide');
					$.notify('Comparision table Created', 'success');
					//location.reload();
					// alert(result);
					$('#compareTable').html(result);
				},
				error:function (error) {
					//alert(error.status);
					if(error.status == 401){
						$('.error-content').html('');
						var errorMsg = '<div class="alert alert-danger">Unauthorized Access. Please re-try</div>'
						$('.error-content').append(errorMsg);
					}  else if (error.status == 422) {
						alert('Please fill Dashboard name');
						//alert
					}
					else if (error.status == 0) {
						$('.error-content').html('');
						var errorMsg = '<div class="alert alert-danger">Something went wrong.</div>'
						$('.error-content').append(errorMsg);
					}
				}
			});
		//}
	});
});