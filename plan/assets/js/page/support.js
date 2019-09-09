$(document).ready(function(){
	$('#sendSupportTicket').on('submit', function(e){
		e.preventDefault();
		alert('clicked');
		$.notify('Sending support request', 'info');
		$.ajax({
			async: true,
		  	url: siteUrl + "/api/sendTicket",
		  	type: 'post',
		  	headers: {
		    	'Accept': 'application/json',
		    	'Authorization': 'Bearer ' + localStorage.token
		  	},
		  	data: $('#sendSupportTicket').serialize(),
		  	success: function(result){
		  		console.log(result);
				//$('.notifyjs-wrapper').trigger('notify-hide');

			}
		});
	});
	$('body').on('click','.delete-ind', function(e){
		var elem = $(this);
		var id = elem.attr('data-ind-id');
		var type = elem.attr('data-type');
		var data = {
			'id': id,
			'type': type
		};
		bootbox.confirm({
              title: "Delete?",
              message: "Are you sure you want to delete this Indicator?",
              buttons: {
                  cancel: {
                      label: '<i class="fa fa-times"></i> Cancel'
                  },
                  confirm: {
                      label: '<i class="fa fa-check"></i> Confirm'
                  }
              },
              callback: function (result) {
                  if(result==true){
                    $.ajax({async: true,
                      url: siteUrl + "/api/deleteInd",
                      headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.token
                      },
                      data: data,
                      type: "post",
                      success: function(result) {
                          if(result == 'true'){
                            $.notify("Deleted successfully!", 'success');
                            // location.reload();
                            elem.closest('.ind-wrap').slideUp(300, function(){
                            	elem.closest('.ind-wrap').remove();
                            });
                          }
                          else{
                          	$.notify("Something went wrong. Please try again.", 'error');
                          }
                      }
                    });
                  }
              }
          });
	});

	$('body').on('submit','#add-achievement', function(e){
		$.notify('Adding Achievements', 'info');
		e.preventDefault();
        //if($.validatr.validateForm($('#scheme-objective-output-add'))){
			var form_data = $(this).serialize() + '&year=' + $('#financial_year').val();
			form_data = form_data + '&quarter=' + $('#financial_quarter').val();
			$.ajax({async: true,
				url: siteUrl + "/api/add_achievements_submit",
				headers: {
					'Accept': 'application/json',
					'Authorization': 'Bearer ' + localStorage.token
				},
				type: 'POST',
				data: form_data,
				success: function(result){
					$('.notifyjs-wrapper').trigger('notify-hide');
					console.log(result);
					location.reload();
				},
				error:function (error) {
					$('.notifyjs-wrapper').trigger('notify-hide');
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