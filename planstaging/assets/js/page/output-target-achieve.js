$(document).ready(function(){

	checkDadminOrHOD();
	var urlParams = new URLSearchParams(window.location.search);
	var target_id = urlParams.get('target_id');


	$.ajax({async: true,
		url: siteUrl + "/api/output_achievent_head_info",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		data: {'target_id': target_id},
		type: 'GET',
		success: function(result){
			$('.head-info').html(result.headInfo);
			$('.objectiveBread').attr('href','scheme-objectives.html?scheme_id=' + $( '.schemeinfo').attr('data-id'));
			$('.outputBread').attr('href',$('.outputBread').attr('href')+'?objective_id=' + $( '.objectiveinfo').attr('data-id'));
			$('.outcomeBread').attr('href',$('.outcomeBread').attr('href')+'?output_id=' + $( '.outputinfo').attr('data-id'));
			$('.IndicatorBread').attr('href',$('.IndicatorBread').attr('href')+'?output_id=' + $( '.outputinfo').attr('data-id'));
			$('.TargetBread').attr('href',$('.TargetBread').attr('href')+'?indicator_id=' + $( '.indicatorinfo').attr('data-id'));
			
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});


	$.ajax({async: true,
		url: siteUrl + "/api/output_achievent_list",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		data: {'target_id': target_id},
		type: 'GET',
		success: function(result){
			$('#achieveTab').DataTable({
				data: result.achievements
			});
			var headInfo = $('#head-info').data('schemename');
			$('.head-info').html(headInfo);
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});

	$('#achievement-add').on('submit', function(e){
		e.preventDefault();
        if($.validatr.validateForm($('#achievement-add'))){
			var form_data = $(this).serialize() + '&target_id=' + target_id;
			$.ajax({async: true,
				url: siteUrl + "/api/output_achievent_save",
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

	$(document).on('click', '.editAchieve', function(){
	 	//alert('here');
      var achId = $(this).attr('data-id');
     var desc = $(this).attr('data-name');
           

      		function fill(a){
			    for(var k in a){
			        $('[name="'+k+'"]').val(a[k]);
			    }
				}

			formdata ={'id':achId,'desc':desc};

			fill(formdata);

           	//console.log(elem);
				
 	});
 	$('#editAchievementForm').on('submit', function(e){
		e.preventDefault();
        if($.validatr.validateForm($('#editAchievementForm'))){
			var form_data = $(this).serialize() ;
			$.ajax({async: true,
				url: siteUrl + "/api/output_achievent_edit",
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

 	$(document).on('click', '.deleteOutputAchievement', function(){
	var id = $(this).attr('data-id');
	if(confirm("Are you sure to delete?")){
		
		$.ajax({async: true,
                      url: siteUrl + "/api/deleteOutputAchievement/" + id,
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