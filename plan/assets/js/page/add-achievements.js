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
			$('#dept-select, #dept-select1')
				.empty()
				.append('<option value="" selected="selected" disabled="disabled">Select a Department</option>');

			if (result.departments.length > 0) {
				$.each(result.departments, function(k, val){
					var newOption = $('<option value="'+val.id+'">'+val.name+'</option>');
					$('#dept-select, #dept-select1').append(newOption);
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
		$.notify('Loading schemes', 'info');
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

	$('#expExcel').on('click',function(e){
		e.preventDefault();
			var schemeId=  $('#dept-select').val();
			var year=  $('#financial_year').val();
			$.ajax({
				url: siteUrl + "/api/export_scheme_indicators",
			  	headers: {
			    	'Accept': 'application/json',
			    	'Authorization': 'Bearer ' + localStorage.token
			  	},
			  	data:{'dept_id':schemeId, 'year': year},
			  	success: function(result){
			  		window.open(siteUrl+'/'+result, '_blank');
			  		// window.location = 
			  	}
			});
	})

	$('#showIndicators').on('submit', function(e){
		e.preventDefault();
		var elem = $(this);
		$.notify('Loading indicators', 'info');
		elem.addClass('loading');
		//var schemeExist ='false';
		var schemeId=  $('#dept-select').val();
		var year=  $('#financial_year').val();

		//alert(schemeName);
		//alert(schemeId);
		$('#IndList').slideUp(300);
			$.ajax({async: true,
				  	url: siteUrl + "/api/show_scheme_indicators",
				  	headers: {
				    	'Accept': 'application/json',
				    	'Authorization': 'Bearer ' + localStorage.token
				  	},
				  	data:{'dept_id':schemeId, 'year': year},
				  	success: function(result){
						$('.notifyjs-wrapper').trigger('notify-hide');
						elem.removeClass('loading');
				  		$('#IndicatorsList').html('');
				  		var htm = '';
				  		var tabhtm = '';
				  		var ind_unit_opt = "";
				  		$.each(result.indicator_units, function(x, val4){
				  			ind_unit_opt += '<option value="'+val4.id+'">'+val4.name+'</option>';
				  		});
				  		if(result.schemes.length > 0){
				  			$.each(result.schemes, function(i, val1){
						  		if(val1.outputs.length > 0) {
						  			htm+='<div class="col-md-12"><h3>'+result.schemes[i].name+'</h3></div>';
		  							htm+='<div class="row" style="margin: 0;"></div>';
						  			htm+='<div class="col-md-6">';
						  			htm+='<h4>Output Indicators</h4>';
									$.each(val1.outputs, function(k, val){
										htm += '<div class="row ind-wrap"><div class="col-md-12"><div class="row form-row ind-row"><div class="col-md-12"><p>&#8594; '+val.name+'</p></div></div>';
										// htm += '<div class="row ind-wrap"><div class="col-md-12"><div class="row form-row ind-row"><div class="col-md-12"><p>&#8594; '+val.name+'</p></div><div class="col-md-4"><input type="hidden" name="ind_ids[]" value="'+val.id+'" /><input type="hidden" name="ind_types[]" value="output" /><select name="ind_unit[]" class="form-control">'+ind_unit_opt+'</select></div><div class="col-md-6"><select class="form-control evaluation_type" name="evaluation_types[]" required="required"><option value="1">On track when Greater than Evaluation criteria</option><option value="2">On track when Less than Evaluation criteria</option></select></div><div class="col-md-2 text-right"><a class="delete-ind" data-ind-id="'+val.id+'" data-type="output">&otimes;</a></div></div>';
										htm+="<br>";
										$.each(val.targets, function(j, val1){
											htm += '<div class="row form-row"><div class="col-md-2"><label>'+val1.name+'</label></div><div class="col-md-2">'+val1.value+'</div><div class="col-md-4"><input type="text" autocomplete="off" name="achievement_val[]" placeholder="Achievement Value" class="form-control" /></div><input type="hidden" name="type[]" value="output" /><input type="hidden" name="target_ids[]" value="'+val1.id+'" /><div class="col-md-4"><textarea class="form-control" name="remarks[]" placeholder="Enter remarks"></textarea></div></div>';
										});
									htm+='</div></div>';
										
									});
									htm+='</div>';
									// $('#outputIndicatorsList').html(htm);
									// $('#outpIndList').slideDown(300);
								}
								if (val1.outcomes.length > 0) {
									htm+='<div class="col-md-6">';
						  			htm+='<h4>Outcome Indicators</h4>';
									$.each(val1.outcomes, function(a, val2){
										if(val2.targets.length){
											htm += '<div class="row ind-wrap"><div class="col-md-12"><div class="row form-row ind-row"><div class="col-md-12"><p>&#8594; '+val2.name+'</p></div></div>';
											// htm += '<div class="row ind-wrap"><div class="col-md-12"><div class="row form-row ind-row"><div class="col-md-12"><p>&#8594; '+val2.name+'</p></div><div class="col-md-4"><input type="hidden" name="ind_ids[]" value="'+val2.id+'" /><input type="hidden" name="ind_types[]" value="outcome" /><select name="ind_unit[]" class="form-control">'+ind_unit_opt+'</select></div><div class="col-md-6"><select class="form-control evaluation_type" name="evaluation_types[]" required="required"><option value="1">On track when Greater than Evaluation criteria</option><option value="2">On track when Less than Evaluation criteria</option></select></div><div class="col-md-2 text-right"><a class="delete-ind" data-ind-id="'+val2.id+'" data-type="outcome">&otimes;</a></div></div>';
											htm+="<br>";
											$.each(val2.targets, function(b, val3){
												htm += '<div class="row form-row"><div class="col-md-2"><label>'+val3.name+'</label></div><input type="hidden" name="type[]" value="outcome" /><input type="hidden" name="target_ids[]" value="'+val3.id+'" /><div class="col-md-2">'+val3.value+'</div><div class="col-md-4"><input type="text" autocomplete="off" name="achievement_val[]" class="form-control" placeholder="Achievement Value" /></div><div class="col-md-4"><textarea class="form-control" name="remarks[]" placeholder="Enter remarks"></textarea></div></div>';
											});
											htm+='</div></div>';
										}								
									});
									htm+='</div><div class="col col-md-12"><button type="submit" class="btn btn-primary">Submit</button></div>';
									// $('#outcomeIndicatorsList').html(htm);
									// $('#outcIndList').slideDown(300);
								}
							});
				  			$.each(result.schemes, function(a, val5){
				  				tabhtm+='<tr><td><h3>'+val5.name+'</h3></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
				  				if(val5.outputs.length > 0) {
				  					tabhtm+='<tr><td><h4>Output Indicators</h4></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
				  					$.each(val5.outputs, function(b, val6){
				  						$.each(val6.targets, function(c, val7){
				  							tabhtm+='<tr><td>'+val7.id+'</td><td>'+val6.name+'</td><td>output</td><td>'+val7.name+'</td><td>'+val7.value+'</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
			  							});

		  							});
				  				}
				  				if(val5.outcomes.length > 0) {
				  					tabhtm+='<tr><td><h4>Outcome Indicators</h4></td><td></td><td><td></td></td><td></td><td></td><td></td></tr>';
				  					$.each(val5.outputs, function(b, val6){
				  						$.each(val6.targets, function(c, val7){
				  							tabhtm+='<tr><td>'+val7.id+'</td><td>'+val6.name+'</td><td>outcome</td><td>'+val7.name+'</td><td>'+val7.value+'</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
			  							});

		  							});
				  				}
							});
							$("#achieveTable").dataTable().fnDestroy();
							$('#achieveTabs').html(tabhtm);
							$('#achieveTable').DataTable({
								"paging":   false,
								"searching": false,
								dom: 'Bfrtip',
								"bSort": false,
						        buttons: [
						            {
						            	extend: 'excelHtml5',
						            	header: true,
						            	exportOptions: {
			                  				columns: ':visible',
			                  				rows: ':not(.not-printable)'
			              				},
									    customize: function( xlsx ) {
        							        var sheet = xlsx.xl.worksheets['sheet1.xml'];
 							                $('row c[r^="B"]', sheet).attr( 's', '55' );
            							},
						            	text: "Export as Excel(.xslx)"
						            }
					        	]
				        	});
							$('#IndList').html(htm);
							$('#IndList').slideDown(300);
				   		}
				 	},
				 	error:function (error) {
				      	console.log(error.status);
				      	if(error.status == 401){
				        
				        
				        
				  	}
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
              //title: "Delete?",
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



	$('#uploadSchemeForm').on('submit', function(e){
        e.preventDefault();
        $(this).find('button[type=submit]').addClass('loading');
        var form = document.forms.namedItem("uploadSchemeForm"); // high importance!, here you need change "yourformname" with the name of your form
		var formdata = new FormData(form);
	 	$.ajax({
			url: siteUrl + "/api/uploadAchieve",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			async: true,
		    type: "POST",
		    // dataType: "json", // or html if you want...
		    contentType: false, // high importance!
		    data: formdata, // high importance!
		    processData: false,
			success: function(result){
				console.log(result);
				alert("Achievements uploaded successfully");
			},
			error:function (error) {
				if(error.status == 401){
					$('.error-content').html('');
					var errorMsg = '<div class="alert alert-danger">Unauthorized Access. Please re-try</div>'
					$('.error-content').append(errorMsg);
				} else if(error.status == 422){
					alert('The imported file must be a file of type: xls, xlsx or csv');
					$('.error-content').html('');
					var errorMsg = '<div class="alert alert-danger">The imported file must be a file of type: xls, xlsx or csv</div>'
					$('.error-content').append(errorMsg);
				} else if (error.status == 0) {
					$('.error-content').html('');
					var errorMsg = '<div class="alert alert-danger">Something went wrong.</div>'
					$('.error-content').append(errorMsg);
				}
			}
		});
    });

});