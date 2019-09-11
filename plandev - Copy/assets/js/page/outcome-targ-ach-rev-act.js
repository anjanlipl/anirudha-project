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
		url: siteUrl + "/api/outcome_actions_head_info",
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
			$('.outcomeBread').attr('href',$('.outcomeBread').attr('href')+'?output_id=' + $( '.outputinfo').attr('data-id'));
			$('.IndicatorBread').attr('href',$('.IndicatorBread').attr('href')+'?outcome_id=' + $( '.outcomeinfo').attr('data-id'));
			$('.TargetBread').attr('href',$('.TargetBread').attr('href')+'?indicator_id=' + $( '.indicatorinfo').attr('data-id'));
			$('.AchievementBread').attr('href',$('.AchievementBread').attr('href')+'?target_id=' + $( '.targetinfo').attr('data-id'));
			$('.ReviewBread').attr('href',$('.ReviewBread').attr('href')+'?achievement_id=' + $( '.achievementinfo ').attr('data-id'));
			
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});

	$.ajax({async: true,
		url: siteUrl + "/api/outcome_actions_list",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		data: {'review_id': review_id},
		type: 'GET',
		success: function(result){
			$('#outcomeActionTab').DataTable({
				data: result.actions
			});
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});

	$('#action-add').on('submit', function(e){
		e.preventDefault();
        if($.validatr.validateForm($('#action-add'))){
			var form_data = $(this).serialize() + '&review_id=' + review_id;
			$.ajax({async: true,
				url: siteUrl + "/api/outcome_action_add",
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
 	$(document).on('click', '.assignUser', function(){
	 	//alert('here');
      var action_id = $(this).attr('data-id');
      //var desc = $(this).attr('data-name');
      	$('#assignActionForm .id').val(action_id);
      	//alert(action_id);
     
           //	var id = $('#editActionForm .id').val(targetId);
           

           	//console.log(elem);
				
 	});
 		$('#assignActionForm').on('submit', function(e){
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
					alert("Assigned Successfully");
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
		
	});
 	$('#editActionForm').on('submit', function(e){
		e.preventDefault();
        if($.validatr.validateForm($('#editActionForm'))){
			var form_data = $(this).serialize() + '&review_id=' + review_id;
			$.ajax({async: true,
				url: siteUrl + "/api/outcome_action_edit",
				headers: {
					'Accept': 'application/json',
					'Authorization': 'Bearer ' + localStorage.token
				},
				type: 'POST',
				data: form_data,
				success: function(result){
					alert("Updated Successfully");
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

	$(document).on('click', '.deleteOutcomeAction', function(){
	var id = $(this).attr('data-id');
	if(confirm("Are you sure to delete?")){
		
		$.ajax({async: true,
                      url: siteUrl + "/api/deleteOutcomeAction/" + id,
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