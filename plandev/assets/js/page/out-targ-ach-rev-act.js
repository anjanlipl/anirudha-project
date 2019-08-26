$(document).ready(function(){
	checkDadminOrHOD();
	var urlParams = new URLSearchParams(window.location.search);
	var review_id = urlParams.get('review_id');
		
		$.ajax({async: true,
		url: siteUrl + "/api/dept_assignto_list",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		type: 'GET',
		success: function(result){
		    	 var htm = '';
      		 $.each( result['users'], function( key, value ) {
       				 htm += '<option  value="'+result['users'][key]['id']+'" > '+ result['users'][key]['name'] +'</option>';
        //console.log( key + ": " + value );
     		 });
	       $.each( result['moreUsers'], function( key, value ) {
	        htm += '<option  value="'+result['moreUsers'][key]['id']+'" > '+ result['moreUsers'][key]['name'] +'</option>';
        //console.log( key + ": " + value );
      		});
      		$('#userList').append(htm);
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});

	$.ajax({async: true,
		url: siteUrl + "/api/output_actions_head_info",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		data: {'review_id': review_id},
		type: 'GET',
		success: function(result){
			$('.head-info').html(result.headInfo);
			$('.objectiveBread').attr('href','scheme-objectives.html?scheme_id=' + $( '.schemeinfo').attr('data-id'));
			$('.outputBread').attr('href',$('.outputBread').attr('href')+'?objective_id=' + $( '.objectiveinfo').attr('data-id'));
			$('.IndicatorBread').attr('href',$('.IndicatorBread').attr('href')+'?output_id=' + $( '.outputinfo').attr('data-id'));
			
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});

	$.ajax({async: true,
		url: siteUrl + "/api/output_actions_list",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		data: {'review_id': review_id},
		type: 'GET',
		success: function(result){
			$('#outputActionTab').DataTable({
				data: result.actions
			});
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});

	$('#output-action-add').on('submit', function(e){
		$.notify('Adding', 'info');
		e.preventDefault();
        if($.validatr.validateForm($('#output-action-add'))){
			var form_data = $(this).serialize() + '&review_id=' + review_id;
			$.ajax({async: true,
				url: siteUrl + "/api/output_action_add",
				headers: {
					'Accept': 'application/json',
					'Authorization': 'Bearer ' + localStorage.token
				},
				type: 'POST',
				data: form_data,
				success: function(result){
					// console.log(result);
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

	
	$(document).on('click', '.editaction', function(){
	 	//alert('here');
      var targetId = $(this).attr('data-id');
      var desc = $(this).attr('data-name');


     
           	var id = $('#editActionForm .id').val(targetId);
           

      		function fill(a){
			    for(var k in a){
			        $('[name="'+k+'"]').val(a[k]);
			    }
				}

			formdata ={'id':targetId,'desc':desc};

			fill(formdata);

           	//console.log(elem);
				
 	});
 	$(document).on('click', '.updateActionPoints', function(){
	 $.notify('Updating', 'info');
	 $.ajax({async: true,
				url: siteUrl + "/api/update_Action_points_status",
				headers: {
					'Accept': 'application/json',
					'Authorization': 'Bearer ' + localStorage.token
				},
				type: 'POST',
				success: function(result){
					$.notify("Updated Successfully", "success");
					//console.log(result);
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
				
 	});
 	$(document).on('click', '.assignUser', function(){
	 	//alert('here');
      var action_id = $(this).attr('data-id');
      //var desc = $(this).attr('data-name');
      	$('#assignActionForm .id').val(action_id);
      	//alert(action_id);
     
           //	var id = $('#editActionForm .id').val(targetId);
           

           	//console.log(elem);
				
 	});
 	$('#editActionForm').on('submit', function(e){
 		$.notify('Updating', 'info');
		e.preventDefault();
        if($.validatr.validateForm($('#editActionForm'))){
			var form_data = $(this).serialize() + '&review_id=' + review_id;
			$.ajax({async: true,
				url: siteUrl + "/api/output_action_edit",
				headers: {
					'Accept': 'application/json',
					'Authorization': 'Bearer ' + localStorage.token
				},
				type: 'POST',
				data: form_data,
				success: function(result){
					$.notify("Updated Successfully", "success");
					// console.log(result);
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

 	$('#assignActionForm').on('submit', function(e){
 		$.notify('Assigning', 'info');
		e.preventDefault();
			var form_data = $(this).serialize();
			$.ajax({async: true,
				url: siteUrl + "/api/assign_action_submit",
				headers: {
					'Accept': 'application/json',
					'Authorization': 'Bearer ' + localStorage.token
				},
				type: 'POST',
				data: form_data,
				success: function(result){
					$('.notifyjs-wrapper').trigger('notify-hide');
					$.notify("Assigned Successfully", 'success');
					// console.log(result);
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
		
	});
	$(document).on('click', '.deleteOutputAction', function(){
	var id = $(this).attr('data-id');
		bootbox.confirm({
          	title: "Delete?",
          	message: "Are you sure you want to delete?",
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
                  		url: siteUrl + "/api/deleteOutputAction/" + id,
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
	});
});