 
$(document).ready(function(){
	
	checkDadminOrHOD();
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
		//$.notify('Loading Implementing agencies.', 'info');
		$.ajax({async: true,
			url: siteUrl + "/api/unitlist",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			type: 'POST',
			data: {
				department_id: $(this).val()
			},
			success: function(result){
				$('.notifyjs-wrapper').trigger('notify-hide');
				$('#unit-select')
					.empty()
					.append('<option selected="selected" disabled="disabled">Select Implementing Agency</option>');
				$('#unit-select').append('<option value="0">NA</option>');

				if (result.units.length > 0) {
					$.each(result.units, function(k, val){
						var newOption = $('<option value="'+val.id+'">'+val.name+'</option>');
						$('#unit-select').append(newOption);
					});
				}
			},
			error:function (error) {
				console.log(error.status);
				if(error.status == 401){
					
					
					
				}
			}
		});
	});

		$('#schemefile').bind('change', function() {
		  //this.files[0].size gets the size of your file.
		  alert(this.files[0].size);
		  var file = this.files[0].size;
	        var sizeInKB = file/1024; //Normally files are in bytes but for KB divide by 1024 and so on
			var sizeLimit= 1024;

			if (sizeInKB >= sizeLimit) {
				$('#schemefile').val('');
			    alert("Max file size is 256KB. Please upload a different file");
			    return false;
			}
		});
 	$('#uploadSchemeForm').on('submit', function(e){
        e.preventDefault();
        $(this).find('button[type=submit]').addClass('loading');
		//alert("here");
		//var formData = new FormData($(this)[0]);

    // add assoc key values, this will be posts values
    //formData.append("file", this.file, this.getName());
       // var formData = $(this).serialize();
        //var formData = new FormData();
        var form = document.forms.namedItem("uploadSchemeForm"); // high importance!, here you need change "yourformname" with the name of your form
		var formdata = new FormData(form);
		var deptId = $('.selectData #dept-select').val();
		var unitId = $('.selectData #unit-select').val();
// ... 
//formData.append('schemefile', document.getElementById("schemefile").files[0]);
		if(deptId != null){
				 $.ajax({async: true,
							url: siteUrl + "/api/scheme_data_upload?deptId="+deptId+ "&&unitId="+unitId,
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
								alert("schemes uploaded successfully");
								location.reload();
								//document.location.href = 'all-schemes.html',true;
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
		}
               
                //$('form')[0].reset();
            
        });

});