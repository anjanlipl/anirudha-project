$(document).ready(function(){
	checkDadmin();
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
			$.notify('Loading Schemes', "info");
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

	$('#showIndicators').on('submit', function(e){
		//var schemeExist ='false';
		e.preventDefault();
		$.notify('Loading Indicators', 'info');
		var dept_id=  $('#dept-select').val();
		var year=  $('#financial_year').val();
		//alert(schemeName);
		//alert(schemeId);
			$.ajax({
				async: true,
			  	url: siteUrl + "/api/show_scheme_indicators",
			  	headers: {
			    	'Accept': 'application/json',
			    	'Authorization': 'Bearer ' + localStorage.token
			  	},
			  	data:{'dept_id':dept_id, 'year': year},
			  	success: function(result){
					$('.notifyjs-wrapper').trigger('notify-hide');
			  		$('#IndicatorsList').html('');
			  		var htm = '<div class="row"><form autocomplete="off" id="add-target"><input type="hidden" name="year" value="'+year+'">';
			  		if(result.schemes.length > 0){
			  			$.each(result.schemes, function(i, val1){
	  						htm+='<h3>'+result.schemes[i].name+'</h3>';
	  						htm+='<div class="row" style="margin: 0px;">';
				  			if (val1.outputs.length > 0) {
				  				htm+='<div class="col-md-6">';
				  				htm+="<h4>Output Indicators</h4>";
								$.each(val1.outputs, function(k, val){
									htm += '<div class="row form-row"><input type="hidden" name="ind_type[]" value="1"><input type="hidden" name="ind_id[]" value="'+val1.outputs[k].id+'"><div class="col-md-4"><label>Indicator</label><br/>'+val1.outputs[k].name+'</div><div class="col-md-4"><label>Value</label><input type="text" autocomplete="off" class="form-control" placeholder="Enter Value" name="value[]"></div><div class="col-md-4"><label>Remark</label><textarea autocomplete="off" id="remark[]" class="form-control" placeholder="Enter Remark" name="remark[]"></textarea></div><input type="hidden" id="targ_start_'+val1.outputs[k].id+'" class="form-control" placeholder="Enter Start date" name="start_date[]"><input type="hidden" id="targ_end_'+val1.outputs[k].id+'" class="form-control" placeholder="Enter End date" name="end_date[]"></div><div class="row form-row"></div>';
								});
								htm+="</div>"
							}

							if (val1.outcomes.length > 0) {
								htm+='<div class="col-md-6">';
								htm+="<h4>Outcome Indicators</h4>";
								$.each(val1.outcomes, function(k, val){
									htm += '<div class="row form-row"><input type="hidden" name="ind_type[]" value="2"><input type="hidden" name="ind_id[]" value="'+val1.outcomes[k].id+'"><div class="col-md-4"><label>Indicator</label><br/>'+val1.outcomes[k].name+'</div><div class="col-md-4"><label>Value</label><input type="text" autocomplete="off" class="form-control" placeholder="Enter Value" name="value[]" ></div><div class="col-md-4"><label>Remark</label><textarea autocomplete="off" id="remark[]" class="form-control" placeholder="Enter Remark" name="remark[]"></textarea></div><input type="hidden" id="targ_start_o_'+val1.outcomes[k].id+'" class="form-control" placeholder="Enter Start date" name="start_date[]"><input type="hidden" id="targ_end_o_'+val1.outcomes[k].id+'" class="form-control" placeholder="Enter End date" name="end_date[]"></div><div class="row form-row"></div>';
									
								});
								htm+='</div>';
							}
					});
			  		}
					htm +='<div class="col col-md-12" style="text-align:center;"><button  type="submit" class="btn btn-primary">Submit</button></div></form></div>';
					$('#IndicatorsList').append(htm);
				}
			});
		});

				// 	$.each(result.outputIndicators, function(k, val){
				// 			var indicator_id = result.outputIndicators[k].id;
				// 			$.ajax({async: true,
				// 					url: siteUrl + "/api/output_baseline_target_name",
				// 					headers: {
				// 						'Accept': 'application/json',
				// 						'Authorization': 'Bearer ' + localStorage.token
				// 					},
				// 					data: {'indicator_id': indicator_id},
				// 					type: 'GET',
				// 					success: function(result2){
				// 						$('#targetName_'+result.outputIndicators[k].id).on('change', function(){
				// 							var bsval = $(this).val();
				// 							bsval = bsval.substring(bsval.indexOf(" ") + 1);
				// 							start_dt = bsval.substring(0, bsval.indexOf("-"))+'-04-01';
				// 							end_date = '20'+ bsval.substring(bsval.indexOf("-") + 1)+'-03-31';
				// 							// alert(start_dt+'------'+end_date);
				// 							$("#targ_start_"+result.outputIndicators[k].id).val(start_dt);
				// 							$("#targ_end_"+result.outputIndicators[k].id).val(end_date);		
				// 						});
				// 						$('#targetName_'+result.outputIndicators[k].id).val(result2.targetName).trigger('change');
										
				// 					},
				// 					error:function (error) {
				// 						console.log(error.status);
				// 						if(error.status == 401){
											
											
											
				// 						}
				// 					}
				// 				});								
				// 		});
				// 	$.each(result.outcomeIndicators, function(k, val){
				// 			var indicator_id = result.outcomeIndicators[k].id;

				// 	$.ajax({async: true,
				// 		url: siteUrl + "/api/outcome_baseline_target_name",
				// 		headers: {
				// 			'Accept': 'application/json',
				// 			'Authorization': 'Bearer ' + localStorage.token
				// 		},
				// 		data: {'indicator_id': indicator_id},
				// 		type: 'GET',
				// 		success: function(result2){
				// 			$('#targetName_o_'+result.outcomeIndicators[k].id).on('change', function(){
				// 							var bsval = $(this).val();
				// 							bsval = bsval.substring(bsval.indexOf(" ") + 1);
				// 							start_dt = bsval.substring(0, bsval.indexOf("-"))+'-04-01';
				// 							end_date = '20'+ bsval.substring(bsval.indexOf("-") + 1)+'-03-31';
				// 							// alert(start_dt+'------'+end_date);
				// 							$("#targ_start_"+result.outcomeIndicators[k].id).val(start_dt);
				// 							$("#targ_end_"+result.outcomeIndicators[k].id).val(end_date);		
				// 						});
				// 						$('#targetName_o_'+result.outcomeIndicators[k].id).val(result2.targetName).trigger('change');
										
							
				// 		},
				// 		error:function (error) {
				// 			console.log(error.status);
				// 			if(error.status == 401){
								
								
								
				// 			}
				// 		}
				// 	});
				// });

			   		
	// 		 	},
	// 		 	error:function (error) {
	// 		      	console.log(error.status);
	// 		      	if(error.status == 401){		        
	// 			  	}
	// 			}
	// 		// }

	// 	});
	
	// });

	$('body').on('submit','#add-target', function(e){
		// alert('here');
		$.notify('Adding Targets', 'info');
		e.preventDefault();
        //if($.validatr.validateForm($('#scheme-objective-output-add'))){
        	var year = $('#financial_year').val();
			var form_data = $(this).serialize() + '&year=' +year;
			// var form_data['year'] = $('#financial_year').val();
			$.ajax({async: true,
				url: siteUrl + "/api/add_targets_submit",
				headers: {
					'Accept': 'application/json',
					'Authorization': 'Bearer ' + localStorage.token
				},
				type: 'POST',
				data: form_data,
				success: function(result){
					$('.notifyjs-wrapper').trigger('notify-hide');
					$.notify("Added Succesfully", "success");
					// console.log(result);
					//location.reload();
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