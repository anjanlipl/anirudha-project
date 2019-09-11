$( document ).ready(function() {
    
    checkSuperAdminOnly();
	$.ajax({async: true,
          url: siteUrl + "/api/evalcriteria",
          headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.token
          },
          success: function(result){
           sectorTable = $('#evalTab').DataTable({
            	data: result['sectors']
           });
         },
         error:function (error) {
              console.log(error.status);
              if(error.status == 401){
                
                
                
              }
          }

     });


	$(document).on('click', '#actionDrop li a', function(){
     	var itemId = $(this).attr('data-id');
     	var actionClass = $(this).attr('class');
     	
      if(actionClass.indexOf('delete') >= 0){
          bootbox.confirm({
              title: "Delete?",
              message: "Are you sure you want to delete this Evaluation Criteria?",
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
                      url: siteUrl + "/api/evalcriteria/" + itemId,
                      headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.token
                      },
                      type: "DELETE",
                      success: function(result) {
                          if(result['deleted'] == "true"){
                            $.notify("Deleted successfully !", 'success');
                            location.reload();
                          }
                      }
                    });
                  }
              }
          });
          // if(confirm("Are you sure to delete?")){
          //       $.ajax({async: true,
          //             url: siteUrl + "/api/evalcriteria/" + itemId,
          //             headers: {
          //               'Accept': 'application/json',
          //               'Authorization': 'Bearer ' + localStorage.token
          //             },
          //             type: "DELETE",
          //             success: function(result) {
          //                 if(result['deleted'] == "true"){
          //                   alert("Deleted successfully !");
          //                  location.reload();
          //                 }
          //             }
          //           });
          //   }
      }
      if(actionClass.indexOf('edit') >= 0){


      			$.ajax({async: true,
			url: siteUrl + "/api/get_criteria_details",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			data:{'itemId':itemId},
			type: 'get',
			success: function(result){
				console.log(result);
				function fill(a){
			    for(var k in a){
			        $('[name="'+k+'"]').val(a[k]);
			    }
				}

			formdata ={'id':result.criteria.id,'percentage_e':result.criteria.percentage,'start_date_e':result.criteria.start_date,'end_date_e':result.criteria.end_date};

			fill(formdata);

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

	 $('#addEvaluationForm').on('submit', function(e){
        $.notify('Adding Evaluation Criteria', 'info');
        e.preventDefault();
        if($.validatr.validateForm($('#addEvaluationForm'))){
            var formData = $(this).serialize();
            $.ajax({async: true,
                url: siteUrl + "/api/evalcriteria",
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.token
                },
                type: "post",
                data: formData,
                success: function(result) {
                    $('#addSectorModal').modal('toggle');
                    $('.notifyjs-wrapper').trigger('notify-hide');
                    location.reload();
                },
                error:function (error) {
                  console.log(error.status);
                  if(error.status == 422){
                    $('.error-content').html('');
                    var errorMsg = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please fill all details .</div>'
                    $('.error-content').append(errorMsg);
                  }
                }
            });
        }

      });


	       $('#editEvalForm').on('submit', function(e){
          $.notify('Updating Evaluation Criteria', 'info');
        e.preventDefault();
        if($.validatr.validateForm($('#editEvalForm'))){
            var id = $('#criteriaId').val();
            var formData = $(this).serialize();
            $.ajax({async: true,
                url: siteUrl + "/api/evalcriteria/" + id,
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.token
                },
                type: "PUT",
                data: formData,
                success: function(result) {
                	  $('.notifyjs-wrapper').trigger('notify-hide');
                    console.log(result);
                    $('#editSectorModal').modal('toggle');
                    location.reload();
                },
                error:function (error) {
                  console.log(error.status);
                  if(error.status == 422){
                    $('.error-content').html('');
                    var errorMsg = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please fill all details.</div>'
                    $('.error-content').append(errorMsg);
                  }
                }
            });
        }
      });

});
