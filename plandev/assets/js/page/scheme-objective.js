$(document).ready(function(){

	checkDadminOrHOD();
	var urlParams = new URLSearchParams(window.location.search);
	var scheme_id = urlParams.get('scheme_id');

	$.ajax({async: true,
		url: siteUrl + "/api/scheme_objectives_head_info",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		data: {'scheme_id': scheme_id},
		type: 'GET',
		success: function(result){
			$('.head-info, .head-info-modal').html(result.headInfo);
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

	$.ajax({async: true,
		url: siteUrl + "/api/scheme_objectives",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		data: {'scheme_id': scheme_id},
		type: 'GET',
		success: function(result){
			$('#schemeObjectives').DataTable({
				data: result.objectives
			});
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});

	
	  $(document).on('click', '.editObjectiveBtn', function(){
      var objId = $(this).attr('data-id');

     //alert(objId);
     	$.ajax({async: true,
			url: siteUrl + "/api/getObjectiveById",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			data: {'objective_id':objId},
			success: function(result){
				console.log(result);
				$('#scheme-objective-edit .obj_name').val(result.objective.name);
				$('#scheme-objective-edit .obj_desc').val(result.objective.description);
				$('#scheme-objective-edit .obj_id').val(result.objective.id);


				// $('#scheme-objective-edit .obj_name')
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

	$('#scheme-objective-add').on('submit', function(e){
		e.preventDefault();
        if($.validatr.validateForm($('#scheme-objective-add'))){
			var form_data = $(this).serialize() + '&scheme_id=' + scheme_id;
			$.ajax({async: true,
				url: siteUrl + "/api/add_scheme_objective",
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

	$('#scheme-objective-edit').on('submit', function(e){
		e.preventDefault();
        if($.validatr.validateForm($('#scheme-objective-edit'))){
			var form_data = $(this).serialize() + '&scheme_id=' + scheme_id;
			$.ajax({async: true,
				url: siteUrl + "/api/edit_scheme_objective",
				headers: {
					'Accept': 'application/json',
					'Authorization': 'Bearer ' + localStorage.token
				},
				type: 'POST',
				data: form_data,
				success: function(result){
					alert('updated successfully !');
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
 $(document).on('click', '.deleteObj', function(){
	var id = $(this).attr('data-id');
	if(confirm("Are you sure to delete?")){
		
		$.ajax({async: true,
                      url: siteUrl + "/api/deleteObjective/" + id,
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