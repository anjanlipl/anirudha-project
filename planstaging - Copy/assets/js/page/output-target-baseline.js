$(document).ready(function(){

	checkDadminOrHOD();
	var urlParams = new URLSearchParams(window.location.search);
	var indicator_id = urlParams.get('indicator_id');


	$.ajax({async: true,
		url: siteUrl + "/api/output_baseline_target_name",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		data: {'indicator_id': indicator_id},
		type: 'GET',
		success: function(result){
			console.log(result);
			$('#baselineName').val(result.baselineName).trigger('change');
			$('#targetName').val(result.targetName).trigger('change');
			
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});

	$.ajax({async: true,
		url: siteUrl + "/api/output_baselines_head_info",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		data: {'indicator_id': indicator_id},
		type: 'GET',
		success: function(result){
			$('.head-info').html(result.headInfo);
			$('.objectiveBread').attr('href','scheme-objectives.html?scheme_id=' + $( '.schemeinfo').attr('data-id'));
			$('.outputBread').attr('href',$('.outputBread').attr('href')+'?objective_id=' + $( '.objectiveinfo').attr('data-id'));
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
		url: siteUrl + "/api/output_baselines_list",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		data: {'indicator_id': indicator_id},
		type: 'GET',
		success: function(result){
			$('#outputBaseline').DataTable({
				data: result.baselines
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

	$.ajax({async: true,
		url: siteUrl + "/api/output_targets_list",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		data: {'indicator_id': indicator_id},
		type: 'GET',
		success: function(result){
			$('#outputTarget').DataTable({
				data: result.targets
			});
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});

	$('#add-baseline').on('submit', function(e){
		e.preventDefault();
        if($.validatr.validateForm($('#add-baseline'))){
			var form_data = $(this).serialize() + '&indicator_id=' + indicator_id;
			$.ajax({async: true,
				url: siteUrl + "/api/output_baseline_save",
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

	$('#add-target').on('submit', function(e){
		e.preventDefault();
        if($.validatr.validateForm($('#add-target'))){
			var form_data = $(this).serialize() + '&indicator_id=' + indicator_id;
			$.ajax({async: true,
				url: siteUrl + "/api/output_target_save",
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

	$(document).on('click', '.editBaseline', function(){
	 	//alert('here');
      var baseId = $(this).attr('data-id');
     
           	var id = $('#editBaselineForm .id').val(baseId);
           	var elem = $(this).parents().eq(1);
      		var name = elem.find('td:nth-child(1)').html();
      		var value = elem.find('td:nth-child(2)').html();
      		var start_date = elem.find('td:nth-child(3)').html();
      		var end_date = elem.find('td:nth-child(4)').html();

      		function fill(a){
			    for(var k in a){
			        $('[name="'+k+'"]').val(a[k]);
			    }
				}

			formdata ={'id':baseId,'base_name':name,'base_value':value};

			fill(formdata);

           	//console.log(elem);
				
 	});
  $(document).on('click', '.deleteOutputBase', function(){
	var id = $(this).attr('data-id');
	if(confirm("Are you sure to delete?")){
		
		$.ajax({async: true,
                      url: siteUrl + "/api/deleteOutputBaseline/" + id,
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

    $(document).on('click', '.deleteOutputTarget', function(){
	var id = $(this).attr('data-id');
	if(confirm("Are you sure to delete?")){
		
		$.ajax({async: true,
                      url: siteUrl + "/api/deleteOutputTarget/" + id,
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
  

 	$('#editBaselineForm').on('submit', function(e){
		e.preventDefault();
        if($.validatr.validateForm($('#editBaselineForm'))){
			var form_data = $(this).serialize();
			$.ajax({async: true,
				url: siteUrl + "/api/output_baseline_edit",
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

	$(document).on('click', '.edittarget', function(){
	 	//alert('here');
      var targetId = $(this).attr('data-id');
     
           	var id = $('#editTargetForm .id').val(targetId);
           	var elem = $(this).parents().eq(1);
           	console.log(elem);
      		var name = elem.find('td:nth-child(1)').html();
      		var value = elem.find('td:nth-child(2)').html();
      		var start_date = elem.find('td:nth-child(3)').html();
      		var end_date = elem.find('td:nth-child(4)').html();

      		function fill(a){
			    for(var k in a){
			        $('[name="'+k+'"]').val(a[k]);
			    }
				}

			formdata ={'id':targetId,'target_name':name,'target_value':value};

			fill(formdata);

           	//console.log(elem);
				
 	});


 		$('#editTargetForm').on('submit', function(e){
		e.preventDefault();
        if($.validatr.validateForm($('#editTargetForm'))){
			var form_data = $(this).serialize() ;
			$.ajax({async: true,
				url: siteUrl + "/api/output_target_update",
				headers: {
					'Accept': 'application/json',
					'Authorization': 'Bearer ' + localStorage.token
				},
				type: 'POST',
				data: form_data,
				success: function(result){
					alert("updated Successfully");
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

	$('#baselineName').on('change', function(){
		var bsval = $(this).val();
		bsval = bsval.substring(bsval.indexOf(" ") + 1);
		start_dt = bsval.substring(0, bsval.indexOf("-"))+'-04-01';
		end_date = '20'+ bsval.substring(bsval.indexOf("-") + 1)+'-03-31';
		// alert(start_dt+'------'+end_date);
		$("#base_start").val(start_dt);
		$("#base_end").val(end_date);		
	});



	$('#targetName').on('change', function(){
		var bsval = $(this).val();
		bsval = bsval.substring(bsval.indexOf(" ") + 1);
		start_dt = bsval.substring(0, bsval.indexOf("-"))+'-04-01';
		end_date = '20'+ bsval.substring(bsval.indexOf("-") + 1)+'-03-31';
		// alert(start_dt+'------'+end_date);
		$("#targ_start").val(start_dt);
		$("#targ_end").val(end_date);		
	});





});