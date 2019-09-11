$(document).ready(function(){

	checkDadminOrHOD();
	var urlParams = new URLSearchParams(window.location.search);
	var achievement_id = urlParams.get('achievement_id');

	$.ajax({async: true,
		url: siteUrl + "/api/output_reviews_head_info",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		data: {'achievement_id': achievement_id},
		type: 'GET',
		success: function(result){
			$('.head-info').html(result.headInfo);
			$('.objectiveBread').attr('href','scheme-objectives.html?scheme_id=' + $( '.schemeinfo').attr('data-id'));
			$('.outputBread').attr('href',$('.outputBread').attr('href')+'?objective_id=' + $( '.objectiveinfo').attr('data-id'));
			$('.outcomeBread').attr('href',$('.outcomeBread').attr('href')+'?output_id=' + $( '.outputinfo').attr('data-id'));
			$('.IndicatorBread').attr('href',$('.IndicatorBread').attr('href')+'?output_id=' + $( '.outputinfo').attr('data-id'));
			$('.AchievementBread').attr('href',$('.AchievementBread').attr('href')+'?target_id=' + $( '.targetinfo').attr('data-id'));
			
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});

	$.ajax({async: true,
		url: siteUrl + "/api/output_reviews_list",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		data: {'achievement_id': achievement_id},
		type: 'GET',
		success: function(result){
			$('#reviewTab').DataTable({
				data: result.reviews
			});
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});

	$('#review-add').on('submit', function(e){
		e.preventDefault();
        if($.validatr.validateForm($('#review-add'))){
			var form_data = $(this).serialize() + '&achievement_id=' + achievement_id;
			$.ajax({async: true,
				url: siteUrl + "/api/output_reviews_add",
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

	$(document).on('click', '.reviewedit', function(){
	 	//alert('here');
      var targetId = $(this).attr('data-id');
      var desc = $(this).attr('data-name');


     
           	var id = $('#editTargetForm .id').val(targetId);
           

      		function fill(a){
			    for(var k in a){
			        $('[name="'+k+'"]').val(a[k]);
			    }
				}

			formdata ={'id':targetId,'desc':desc};

			fill(formdata);

           	//console.log(elem);
				
 	});
 	$('#editReviewForm').on('submit', function(e){
		e.preventDefault();
        if($.validatr.validateForm($('#editReviewForm'))){
			var form_data = $(this).serialize() + '&achievement_id=' + achievement_id;
			$.ajax({async: true,
				url: siteUrl + "/api/output_reviews_edit",
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

		$(document).on('click', '.deleteOutputReview', function(){
	var id = $(this).attr('data-id');
	if(confirm("Are you sure to delete?")){
		
		$.ajax({async: true,
                      url: siteUrl + "/api/deleteOutputReview/" + id,
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