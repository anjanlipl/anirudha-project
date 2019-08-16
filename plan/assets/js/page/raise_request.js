$(document).ready(function(){
	checkDadminOrHOD();
	// Fill in the sector List
	$.ajax({async: true,
		url: siteUrl + "/api/raiseRequestSchemeList",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		success: function(result){
			console.log(result);
			$.each(result.schemes, function(k, val){

				if(val != '' ){

					$.each(val, function(k2, val2){
						var newOption = $('<option value="'+val2.id+'">'+val2.name+'</option>');
						$('#scheme-select').append(newOption);

					});
					
				}
				
			});
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});
	$('#raiseRequestForm').on('submit', function(e){
        e.preventDefault();
        if($.validatr.validateForm($('#raiseRequestForm'))){
	        var formData = $(this).serialize();
	        $.ajax({async: true,
	            url: siteUrl + "/api/raiseRequestFormSubmit",
	            headers: {
	                'Accept': 'application/json',
	                'Authorization': 'Bearer ' + localStorage.token
	            },
	            type: "post",
	            data: formData,
	            success: function(result) {
	                // $('#addSectorModal').modal('toggle');
	                alert('Request raised');
	                location.reload();
	            },
	            error:function (error) {
	              console.log(error.status);
	              if(error.status == 422){
	                $('.error-content').html('');
	                var errorMsg = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Duplicate Entry. Please enter a different sector name.</div>'
	                $('.error-content').append(errorMsg);
	              }
	            }
	        });
        }
      });
});